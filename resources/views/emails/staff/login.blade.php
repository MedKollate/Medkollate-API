<div>
    <h1>{{ $staff->first_name }}, Your login details</h1>
    <p>Your username is: <b>{{ $staff->unique_id }}</b></p>
    <p>Your password is: <b>{{ $password }}</b></p>

    <p>Remember to save your login details.</p>
</div>