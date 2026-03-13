<?php
include "config.php";

if(!isset($_SESSION['admin'])){
header("Location: login.php");
exit;
}

/* APPROVE */
if(isset($_GET['approve'])){

$id=$_GET['approve'];

$conn->query("UPDATE payments SET status='Approved' WHERE id='$id'");

echo "<script>alert('Payment Approved')</script>";
}

/* DELETE */
if(isset($_GET['delete'])){

$id=$_GET['delete'];

$res=$conn->query("SELECT proof FROM payments WHERE id='$id'");
$row=$res->fetch_assoc();

unlink("uploads/".$row['proof']);

$conn->query("DELETE FROM payments WHERE id='$id'");
}
?>

<h2>Admin Dashboard</h2>

<table>

<tr>
<th>Name</th>
<th>Phone</th>
<th>Plan</th>
<th>Amount</th>
<th>Proof</th>
<th>Status</th>
<th>Action</th>
</tr>

<?php
$result=$conn->query("SELECT * FROM payments ORDER BY id DESC");

while($row=$result->fetch_assoc()){
?>

<tr>

<td><?php echo htmlspecialchars($row['fullname']); ?></td>
<td><?php echo htmlspecialchars($row['phone']); ?></td>
<td><?php echo htmlspecialchars($row['plan']); ?></td>
<td><?php echo htmlspecialchars($row['amount']); ?></td>

<td>
<a href="uploads/<?php echo $row['proof']; ?>" target="_blank">View</a>
</td>

<td><?php echo $row['status']; ?></td>

<td>

<a href="?approve=<?php echo $row['id']; ?>">Approve</a> |

<a href="?delete=<?php echo $row['id']; ?>">Delete</a>

</td>

</tr>

<?php } ?>

</table>