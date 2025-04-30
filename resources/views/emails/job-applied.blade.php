<!DOCTYPE html>
<html>

<head>
  <title>Workopia Job Application</title>
</head>

<body>
  <p>There has been a new job application to your Workopia listing</p>

  <p><strong>Job Title:</strong> {{ $job->title }}</p>

  <p><strong>Application Details:</strong></p>

  <p><strong>Full Name:</strong> {{ $application->full_name }}</p>
  <p><strong>Contact Number:</strong> {{ $application->contact_number }}</p>
  <p><strong>Contact Email:</strong> {{ $application->contact_email }}</p>
  <p><strong>Message:</strong> {{ $application->message }}</p>
  <p><strong>Location:</strong> {{ $application->location }}</p>

  <p>Log in to your Workopia account to view the application</p>
</body>

</html>