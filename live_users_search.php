<?php
include_once 'includes.php';

$current_login = Session::get_user_login();

$pattern = $_POST["pattern"];
$selected_logins = json_decode($_POST["list"]);

$users_list = Functions::get_users_by_login_pattern($pattern);
?>

<table class="">
  <tbody>
 	<?php 
	if (count($users_list) == 0) { ?>
		<tr>
			<td class="text-danger">
				Pas de résultat!
			</td>
		</tr>
		<?php
	} else { 
		$nbr = 0; 
		foreach ($users_list as $row) { 
			if (!in_array($row["login"], $selected_logins) && $current_login != $row["login"]) { 
				$nbr++; ?>
			    <tr>
			      <td><?php echo $row["login"]; ?></td>
			      <td class="text-center user-weight"></td>
			      <td class="text-right">
			      	<a href='#'>
			      		<img class='add-user-plus' src='icons/squared-plus.svg' 
			      			onclick="userSelected($(this));" selected-user="no" 
			      			user-login="<?php echo $row["login"]; ?>">
			      	</a>
			      	<!-- <a href='#' hidden><img class='add-user-plus' src='icons/squared-minus.svg'></a> -->
			      </td>
			    </tr>
			    <?php 
			}
		}
		if ($nbr == 0) { ?>
			<tr>
				<td class="text-danger">
					Pas de résultat!
				</td>
			</tr>
			<?php
		}
	} ?>
  </tbody>
</table>