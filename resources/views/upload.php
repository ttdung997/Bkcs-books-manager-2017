<form method="post" action="/mselect">
    <select multiple="multiple" size="6" class="form-control" name="loaixe[]" id="exampleSelect2" style="height: 200px;" >
        <option value="1">Kia Morning 1.25 Si MT</option>
        <option  value="2">Kia Morning 1.25 Si AT</option>
        <option  value="3">Kia Sedona 3.3 GATH</option>
        <option  value="4">Honda City 1.5AT</option>
        <option  value="5">Honda Civic 1.5 Turbo</option>
        <option  value="6">Honda CR-V 2.0AT</option>
        <option  value="7">Ford EcoSport 1.5AT Titanium</option>
        <option  value="8">Ford Everest Titanium 2.2AT 4x2</option>
        <option  value="9">Ford Ranger XLS 2.2L - 4x2 AT</option>
    </select>
    <?php echo Form::token(); ?>
    <button type="submit" class="btn btn-primary">Đăng kí</button>
</form>