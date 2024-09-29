<!-- resources/views/emails/rsvp/rsvp_response.blade.php -->

<!DOCTYPE html>

<html>

<head>

    <title>New RSVP Response</title>

</head>

<body>

<h1>New RSVP Response</h1>

<p>New RSVP response submitted by <strong>{{$guest->name}} (id: {{$guest->id}})</strong></p>

<h2>Guest Details</h2>
<ul>
    <li><strong>Name:</strong> {{$guest->name}}</li>
    <li><strong>Email:</strong> {{$guest->email ?? '----'}}</li>
    <li><strong>Phone:</strong> {{$guest->phone ?? '----'}}</li>
    <li><strong>Coming:</strong> {{$rsvp->coming ? 'Yes' : 'No'}}</li>
    <li><strong>Guest Type:</strong> {{$guest->guestType === 'all_day' ? 'All Day' : 'Evening'}}</li>
    @if($rsvp->coming)
        @if($guest->plusOneAllowed)
            <li><strong>Bringing Plus One:</strong> {{$rsvp->bringingPlusOne ? 'Yes' : 'No'}}</li>
        @endif
        @if($guest->guestType === 'all_day')
            <li><strong>Alcohol:</strong> {{$rsvp->alcohol ? 'Yes' : 'No'}}</li>
        @endif
        <li><strong>Dietary Requirements:</strong> {{$rsvp->dietaryRequirements ?? '----'}}</li>
        <li><strong>Song Requests:</strong> {{$rsvp->songRequests ?? '----'}}</li>
        <li><strong>Hated Songs:</strong> {{$rsvp->hatedSongs ?? '----'}}</li>
    @endif
</ul>

<!-- if plus one, show plus one details -->
@if($rsvp->bringingPlusOne)
    <h2>Plus One Details</h2>
    <ul>
        <li><strong>Name:</strong> {{$plusOne->name}}</li>
        @if($plusOne->guestType === 'all_day')
            <li><strong>Alcohol:</strong> {{$plusOneRsvp->alcohol ? 'Yes' : 'No'}}</li>
        @endif
        <li><strong>Dietary Requirements:</strong> {{$plusOneRsvp->dietaryRequirements ?? '----'}}</li>
        <li><strong>Song Requests:</strong> {{$plusOneRsvp->songRequests ?? '----'}}</li>
        <li><strong>Hated Songs:</strong> {{$plusOneRsvp->hatedSongs ?? '----'}}</li>
    </ul>
@endif
</body>

</html>
