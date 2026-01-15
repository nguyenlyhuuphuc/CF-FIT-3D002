<h1><?= $title ?></h1>

<table border="1">
    <tr>
        <th>STT</th>
        <th>Name</th>
        <th>Age</th>
        <th>Address</th>
    </tr>
    <?php 
        $stt = 1;
        $class = 'style="background-color:gray"';
        foreach($students as $student) : 
    ?>
        <tr <?= $stt % 2 === 0 ? $class : '' ?>>
            <td><?= $stt++ ?></td>
            <td><?= $student['name'] ?></td>
            <td><?= $student['age'] ?></td>
            <td><?= $student['address'] ?></td>
        </tr>
    <?php endforeach ?>

    <?php if(!count($students)) : ?>
    <tr>
        <td colspan="4">No data</td>
    </tr>
    <?php endif ?>
</table>