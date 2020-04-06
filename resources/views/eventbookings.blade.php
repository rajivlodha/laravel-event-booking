@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					<h1>Book Stall @ {{ $event->eventname }} ({{ $event->place }})</h1>
					<p></p>


					
					<h2>Book Stall: #{{ $stallid }}</h2>


					<form name="regForm" novalidate="novalidate" action="/save" method="post" enctype="multipart/form-data">
						<input type="hidden" name="_token" value="{{ csrf_token() }}">
						<input type="hidden" name="eventid"	value="{{ $event->id }}" />
						<input type="hidden" name="stallid"	value="{{ $stallid }}" />
			            <table border = "0"> 
			               <tr>
			                  <td width="200">Company Name:</td>
			                  <td><input name = "compname" type = "text" ng-model = "compname" ng-required="true" ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.compname.$dirty && regForm.compname.$invalid">
			                        <span ng-show = "regForm.compname.$error.required">Company Name is required.</span>
			                     </span>
			                  </td>
			               </tr>

			               <tr>
			                  <td>Contact Person: </td>
			                  <td><input name = "contact"  type = "text" ng-model = "contact" ng-required="true"  ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.contact.$dirty && regForm.contact.$invalid">
			                        <span ng-show = "regForm.contact.$error.required">Contact Person is required.</span>
			                     </span>
			                  </td>
			               </tr>
			               
			               <tr>
			                  <td>Email: </td><td><input name = "email" type = "email" ng-model="email" length = "100" ng-required="true"  ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.email.$dirty && regForm.email.$invalid">
			                        <span ng-show = "regForm.email.$error.required">Email is required.</span>
			                        <span ng-show = "regForm.email.$error.email">Invalid email address.</span>
			                     </span>
			                  </td>
			               </tr>

			               <tr>
			                  <td>Address: </td>
			                  <td><input name = "address"  type = "text" ng-model = "address" ng-required="true"  ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.address.$dirty && regForm.address.$invalid">
			                        <span ng-show = "regForm.address.$error.required">address is required.</span>
			                     </span>
			                  </td>
			               </tr>

			               <tr>
			                  <td>Enter Website: </td>
			                  <td><input name = "website"  type = "text" ng-model = "website" ng-required="true"  ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.website.$dirty && regForm.website.$invalid">
			                        <span ng-show = "regForm.website.$error.required">website is required.</span>
			                     </span>
			                  </td>
			               </tr>

			               <tr>
			                  <td>Company Logo: </td>
			                  <td><input name="complogo" ng-model="complogo" type="file" ng-required="true" />
			                  </td>
			               </tr>

			               <tr>
			                  <td>Marketing Material: </td>
			                  <td><input name="compppt" ng-model="compppt" type="file" ng-required="true" />
			                  </td>
			               </tr>
			               
			               <tr>
			                  <td colspan="2">
			                  
			                     <button class="btn btn-primary" ng-disabled="(regForm.compname.$dirty && regForm.compname.$invalid) ||( regForm.contact.$dirty && regForm.contact.$invalid) || (regForm.address.$dirty && regForm.address.$invalid) || (regForm.email.$dirty && regForm.email.$invalid) || (regForm.website.$dirty && regForm.website.$invalid)" ng-click="submit()" >Confirm Reservation</button>

			                  <!--    
								<button class="btn btn-primary" disabled="@{{ regForm.$invalid }}">Cofirm Reservation</button>

								-->
			                  </td>
			               </tr>
								
			            </table>
			         </form>

					  
					




				</div>
			</div>
		</div>
	</div>
</div>
@endsection
