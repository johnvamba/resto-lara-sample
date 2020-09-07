@extends('emails.email_template')

@section('content')
<!-- START CENTERED WHITE CONTAINER -->
<table role="presentation" class="main">

	<!-- START MAIN CONTENT AREA -->
	<tr>
		<td class="wrapper">
			<table role="presentation" border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td>
						<p>Hi {{$username ?? 'there'}},</p>
						<p>Your reservation has been approved</p>
						<div>
							
						</div>
					</td>
				</tr>
			</table>
		</td>
	</tr>
<!-- END MAIN CONTENT AREA -->
</table>
<!-- END CENTERED WHITE CONTAINER -->
@endsection