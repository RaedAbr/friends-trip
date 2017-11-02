-----------------
--create tables--
-----------------
create table if not exists trip."event" (
	"id" serial constraint pk_event primary key,
	"name" text,
	"date" timestamp,
	"creator" varchar(30) constraint ref_user_login references trip."user"("login")
		on delete cascade on update cascade
	);

create table if not exists trip."user" (
	"login" varchar(30) constraint pk_user primary key,
	"password" varchar(30),
	"email" varchar(50) 
	);

create table if not exists trip."user_event" (
	"user_weight" integer default 1,
	"event_id" integer constraint ref_event_id references trip."event"("id")
		on delete cascade on update cascade,
	"user_login" varchar(30) constraint ref_user_login references trip."user"("login")
		on delete cascade on update cascade,
	constraint pk_user_event primary key ("event_id", "user_login")
	);

create table if not exists trip."expense" (
	"id" serial constraint pk_expense primary key,
	"nature" text,
	"cost" decimal(20, 2) default 0 check ("cost" >= 0),
	"date" timestamp default now(),
	"event_id" integer constraint ref_event_id references trip."event"("id")
		on delete cascade on update cascade,
	"user_login" varchar(30) constraint ref_user_login references trip."user"("login")
		on delete cascade on update cascade
	);

create table if not exists trip."expense_concerned" (
	"expense_id" integer constraint ref_expense_id references trip."expense"("id")
		on delete cascade on update cascade,
	"concerned" varchar(30) constraint ref_user_login references trip."user"("login")
		on delete cascade on update cascade,
	constraint pk_expense_concerned primary key ("expense_id", "concerned")
	);

-------------
--functions--
-------------
/**
	@summary Delete all database tables.
	@returns void
	@example select drop_all_tables();
**/
create or replace function trip.drop_all_tables() returns void as $$
	drop table if exists trip."event" cascade;
	drop table if exists trip."user" cascade;
	drop table if exists trip."user_event" cascade;
	drop table if exists trip."expense" cascade;
	drop table if exists trip."expense_concerned" cascade;
	drop function trip.before_insert_expense_concerned() cascade;
	drop function trip.get_user_situation ( integer, character varying, character varying) cascade ;
$$ language sql;

/**
	@summary Verify if the concerned user by an expense is in the concerned event.
		If not, it raises an exception and there will be no insertion.
	@returns trigger
**/
create or replace function trip.before_insert_expense_concerned() returns trigger as $$
	declare
		tuple record;
		event integer;
	begin
		select event_id into event from trip.expense
			where new.expense_id = id;

		select * into tuple from trip.user_event
			where event = event_id and new.concerned like user_login;

		if not found then
			raise exception '"%" can not be concerned by the expense "%" !', new.concerned, new.expense_id;
		end if;
		return new;
	end;
$$ language plpgsql;

/**
	@summary Get the amount that a user must to an other in an event.
	@param integer : the event id
	@param varchar(30) : the user login
	@param varchar(30) : the beneficiary
	@returns decimal(20, 2) : the amount that must be paid
	@example select get_user_situation(1, 'user1', 'user2');
**/
create or replace function trip.get_user_situation(integer, varchar(30), varchar(30))
	returns decimal(20, 2)
	as $$
	declare
		cur cursor for select * from trip.concerned_users_by_expenses c
			where c.event_id = $1 and c.expense_owner like $2 and c.concerned like $3
			and c.concerned not like $2;
		el record;
		nb integer;
		w integer;
		amount decimal(20, 2);
	begin
		amount := 0;
		for el in cur loop
			select parts_nb into nb from trip.parts_of_expense
				where expense_id = el.expense_id;

			select u.user_weight into w from trip.user_event u
				where u.user_login like el.concerned and el.event_id = u.event_id;

			amount := amount + (el.cost) / nb * w;
		end loop;

		RETURN amount;
	end;
$$ language plpgsql;

/**
	@summary Get the list of expenses and their parts number.
	@column expense_id(integer) : the expense id
	@column parts_nb(integer) : the parts number
**/
create or replace view trip.parts_of_expense as
	select r.expense_id, sum(r.user_weight) as parts_nb from (
		select res.expense_id, res.concerned, u.event_id, user_weight from (
			select ec.expense_id, ec.concerned, e.event_id from trip.expense_concerned ec 
			join trip.expense e on e.id = ec.expense_id
		) res join trip.user_event u on res.event_id = u.event_id 
			where res.concerned = u.user_login
	) as r group by r.expense_id, r.event_id;

/**
	@summary Get the list of the concerned users by expenses
	@column event_id(integer) : the event id
	@column concerned(varchar(30)) : the user login
	@column expense_owner(decimal(20, 2)) : the beneficiary
	@column cost(decimal(20, 2)) : the cost of the expense
	@column expense_id(integer) : the expense id
**/
create or replace view trip.concerned_users_by_expenses as
	select e.event_id, ec.concerned, e.user_login as expense_owner, e.cost, ec.expense_id 
	from trip.expense_concerned ec join trip.expense e on e.id = ec.expense_id;

------------
--triggers--
------------

drop trigger if exists before_insert_expense_concerned_trigger on trip.expense_concerned cascade;

create trigger before_insert_expense_concerned_trigger
	before insert on trip.expense_concerned
	for each row execute procedure trip.before_insert_expense_concerned();