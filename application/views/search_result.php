<table>
    <?php foreach ($results as $row): ?>
        <tr>
            <td><?php echo $row->id ?></td>
            <td><a href="<?php print site_url('home/'.$row->id); ?>"><?php echo $row->login ?></a></td>
            <td><?php echo $row->mail ?></td>
            <td><?php echo $row->type ?></td>
            <td><?php echo $row->created ?></td>
            <td><?php echo $row->updated ?></td>
        </tr>
    <?php endforeach; ?>
</table>