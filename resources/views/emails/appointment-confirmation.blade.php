<!DOCTYPE html>
<html>

<head>
    <title>Appointment Confirmation</title>
</head>

<body>

    <h2>Appointment Confirmed</h2>

    <p>Hello {{ $appointment->patient->name }}</p>

    <p>
        Your appointment has been booked successfully.
    </p>

    <p>
        Doctor:
        {{ $appointment->doctor->user->name }}
    </p>

    <p>
        Date:
        {{ $appointment->appointment_date }}
    </p>

    <p>
        Time:
        {{ $appointment->appointment_time }}
    </p>

</body>

</html>
