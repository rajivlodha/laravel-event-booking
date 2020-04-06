@extends('app')

@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-10 col-md-offset-1">
			<div class="panel panel-default">
				<div class="panel-heading">Home</div>

				<div class="panel-body">
					
					<h2>Visitors Log Book</h2>


					<form name="regForm" novalidate="novalidate" action="/savevisitor" method="post" >
			            <table border = "0"> 
							<input type="hidden" name="_token" value="{{ csrf_token() }}">

							<tr>
								<td>Event</td>
								<td>
									<select name="eventid" id="eventid">
										<option value="0">Select Event</option>	
									@foreach($events as $row)
										<option value="{{ $row->id }}">
										{{ $row->eventname }}</option>
									@endforeach		
									</select>

								</td>
							</tr>



							<tr>
								<td>Stall</td>
								<td>
									<select name="stallid" id="stallid"></select>
								</td>
							</tr>


			               <tr>
			                  <td>Visitor Name: </td>
			                  <td><input name = "contact"  type = "text" ng-model = "contact" ng-required="true"  ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.contact.$dirty && regForm.contact.$invalid">
			                        <span ng-show = "regForm.contact.$error.required">Name is required.</span>
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
			                  <td>Phone: </td>
			                  <td><input name = "phone"  type = "text" ng-model = "phone" ng-required="true"  ng-minlength="5" ng-maxlength="50" required="required" value="">
			                     <span style = "color:red" ng-show = "regForm.phone.$dirty && regForm.phone.$invalid">
			                        <span ng-show = "regForm.phone.$error.required">phone is required.</span>
			                     </span>
			                  </td>
			               </tr>
			               <tr><td colspan="2">&nbsp;</td></tr>
			               <tr>
			                  <td colspan="2">
			                  
			                     <button class="btn btn-primary" ng-disabled="(regForm.contact.$dirty && regForm.contact.$invalid) || (regForm.phone.$dirty && regForm.phone.$invalid) || (regForm.email.$dirty && regForm.email.$invalid) || (regForm.website.$dirty && regForm.website.$invalid)" ng-click="submit()" >Confirm Reservation</button>

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
