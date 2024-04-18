<?php
    // Fetch all join requests for communities managed by the current admin
    $query = "SELECT * FROM join_requests WHERE community_id IN (SELECT community_id FROM communities WHERE admin_id = :admin_id)";
    $stmt = $db->prepare($query);
    $stmt->bindValue(':admin_id', $admin_id);
    $stmt->execute();
    $join_requests = $stmt->fetchAll(PDO::FETCH_ASSOC);
    $stmt->closeCursor();
?>
<!-- Display join requests -->
<?php foreach($join_requests as $request) : ?>
    <div>
        <p>User <?php echo $request['user_id']; ?> wants to join community <?php echo $request['community_id']; ?></p>
        <form action="accept-request.php" method="post">
            <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
            <input type="submit" value="Accept">
        </form>
        <form action="deny-request.php" method="post">
            <input type="hidden" name="request_id" value="<?php echo $request['request_id']; ?>">
            <input type="submit" value="Deny">
        </form>
    </div>
<?php endforeach; ?>