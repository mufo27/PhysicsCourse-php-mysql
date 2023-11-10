<?php
if ($ans != '') {

    if ($ans == $j) {

        if ($row_exe_t1['exq_answer'] == $ans) {

            $tr = '<tr style="background-color: #c8e6c9;">';
            $sh_icon = '<h1><i class="bi bi-check-lg text-success"></i></h1>';
            $check_true_frm1++;
        } else {

            $tr = '<tr style="background-color: #ffcdd2;">';
            $sh_icon = '<h1><i class="bi bi-x-lg text-danger"></i></h1>';
            $check_true_frm1 = $check_true_frm1;
        }
    } else {

        if ($row_exe_t1['exq_answer'] == $j) {

            $tr = '<tr style="background-color: #bbdefb;">';
        } else {
            $tr = '<tr>';
        }
    }
} else {

    $tr = '<tr>';
}
?>


<style type="text/css">
    input.largerCheckbox {
        width: 20px;
        height: 20px;
    }
</style>

<?= $tr; ?>

<td style="width:5%; text-align: center; vertical-align: middle;">
    <?= $j; ?>.
</td>
<td style="width:15%; text-align: center; vertical-align: middle;">

    <label>
        <input type="radio" class="largerCheckbox" name="opt_<?= $val; ?>" value="<?= $j; ?>" <?php if ($ans == $j) echo "checked"; ?> required="">
        <span></span>
    </label>
</td>
<td style="width:70%; vertical-align: middle;">
    <?= $row_exe_t1['opt_' . $j]; ?>
</td>

<td style="width:10%; text-align: center; vertical-align: middle;">
    <?php if ($ans != '' && $ans == $j) { ?>
        <?= $sh_icon; ?>
    <?php } ?>
</td>

</tr>