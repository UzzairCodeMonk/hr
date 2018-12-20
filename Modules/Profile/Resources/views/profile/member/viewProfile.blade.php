@extends('layouts.member.master')
@section('content')
<div class="row">
	<div class="col-md-12">

		<!-- Form -->
      <div class="card">
	  <div class="card-header bg-dark text-white d-flex justify-content-between">
				<span class="font-size-sm text-uppercase font-weight-semibold">My Profile</span>
			<div class="list-icons">
				<a class="list-icons-item" data-action="collapse"></a>
				<a class="list-icons-item" data-action="reload"></a>
			</div>
			</div>
			  <div class="card-header bg-light">
            <h6 class="card-title">Details</h6>
			</div>


			<div class="card-body tab-content">
				<div class="tab-pane fade show active" id="card-toolbar-tab1">

						<!-- Component -->
				<form action="#">
                  <div class="form-row">	
					<div class="form-group col-md-6">
					 <dl>
                        <dt>Name</dt>
						<dd>HERMIONE GRANGER</dd>
                     </dl>
					</div>

                    <div class="form-group col-md-6">
                     <dl>
						<dt>NRIC</dt>
						<dd>900101115432</dd>
                     </dl>
					</div>
                  </div>

                  <div class="form-row">	
				   <div class="form-group col-md-6">
					<dl>
                        <dt>Date Of Birth</dt>
						<dd>1 January 1990 &ensp; | &ensp; Age:  </dd>
                    </dl>
				   </div>

                  <div class="form-group col-md-6">
                    <dl>
						<dt>Gender</dt>
						<dd>Female</dd>
                    </dl>
				  </div>
              </div>    

               <div class="form-row">	
				<div class="form-group col-md-6">
				   <dl>
                        <dt>Maritial Status</dt>
						<dd>Single</dd>
                   </dl>
				</div>

                <div class="form-group col-md-6">
                   <dl>
						<dt>Email</dt>
						<dd>test53@gmail.com</dd>
                   </dl>
				</div>
              </div>                        

              <div class="form-row">	
				<div class="form-group col-md-6">
				  <dl>
                       <dt>Current Address</dt>
					   <dd>Lot S206-207 2nd Floor, The Gardens Mall
                        <br> Lingkaran Syed Putra, Mid Valley City
                        <br>59200 Kuala Lumpur
                        <br> Wilayah Persekutuan Kuala Lumpur</dd>
                  </dl>
				</div>

               <div class="form-group col-md-6">
               <dl>
				<dt>Permanent Address</dt>
				    <dd>Lot S206-207 2nd Floor, The Gardens Mall
                    <br> Lingkaran Syed Putra, Mid Valley City
                    <br>59200 Kuala Lumpur
                    <br> Wilayah Persekutuan Kuala Lumpur</dd>
                </dl>
				</div>
              </div>

              <div class="form-row">	
				<div class="form-group col-md-6">
				<dl>
                    <dt>Race</dt>
				    <dd>Bumiputera</dd>
                </dl>
			  </div>

               <div class="form-group col-md-6">
               <dl>
				   <dt>Nationality</dt>
				   <dd>Malaysia</dd>
                </dl>
				</div>
              </div> 

              <div class="form-row">	
				<div class="form-group col-md-6">
				 <dl>
                  <dt>Phone No</dt>
				  <dd>037691523</dd>
                </dl>
				</div>

               <div class="form-group col-md-6">
                <dl>
                    <dt>Mobile No</dt>
                    <dd>0123456789</dd>
                  </dl>
				</div>
              </div>                

			<div class="text-right">
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#modal_form_vertical">Update<i class="icon-paperplane ml-2"></i></button>
			</div>
		</form>
						<!-- /component -->
		</div>
    </div>
</div>



            
			<!-- /form -->
<div id="modal_form_vertical" class="modal fade" tabindex="-1">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">{{ucwords(__('update profile'))}}</h5>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <form action="#">
        <div class="modal-body">

          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label>{{ucwords(__('name'))}}</label>
                <input type="text" placeholder="Eugene" class="form-control">
              </div>

              <div class="col-sm-6">
                <label>{{strtoupper(__('nric'))}}</label>
                <input type="text" placeholder="Kopyov" class="form-control">
              </div>
            </div>
        </div>


          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label>{{ucwords(__('date of birth'))}}</label>
                <input type="text" placeholder="Ring street 12" class="form-control">
              </div>

              <div class="col-sm-6">
                <label>{{ucwords(__('Gender'))}}</label>
                <input type="text" placeholder="building D, flat #67" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <label>{{ucwords(__('maritial status'))}}</label>
                <input type="text" placeholder="Munich" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('e-mail'))}}</label>
                <input type="text" placeholder="Bayern" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('current address 1'))}}</label>
                <input type="text" placeholder="1031" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
          <div class="row">          
          <div class="col-sm-4">
                <label>{{ucwords(__('current address 2'))}}</label>
                <input type="text" placeholder="Bayern" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('current address 3'))}}</label>
                <input type="text" placeholder="1031" class="form-control">
                </div>
            </div>
          </div>

          
          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <label>{{ucwords(__('permanent address 1'))}}</label>
                <input type="text" placeholder="Munich" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('permanent address 2'))}}</label>
                <input type="text" placeholder="Bayern" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('permanent address 3'))}}</label>
                <input type="text" placeholder="1031" class="form-control">
              </div>
            </div>
          </div>

          <div class="form-group">
            <div class="row">
              <div class="col-sm-4">
                <label>{{ucwords(__('race'))}}</label>
                <input type="text" placeholder="Munich" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('nationality'))}}</label>
                <input type="text" placeholder="Bayern" class="form-control">
              </div>

              <div class="col-sm-4">
                <label>{{ucwords(__('permanent address 3'))}}</label>
                <input type="text" placeholder="1031" class="form-control">
              </div>
            </div>
          </div>


          <div class="form-group">
            <div class="row">
              <div class="col-sm-6">
                <label>Email</label>
                <input type="text" placeholder="eugene@kopyov.com" class="form-control">
              </div>

              <div class="col-sm-6">
                <label>Phone No</label>
                <input type="text" placeholder="+99-99-9999-9999" class="form-control">
              </div>

              <div class="col-sm-6">
                <label>Mobile No</label>
                <input type="text" placeholder="+99-99-9999-9999" class="form-control">
              </div>
            </div>
          </div>
        </div>
        

        <div class="modal-footer">
          <button type="button" class="btn btn-link" data-dismiss="modal">Close</button>
          <button type="submit" class="btn bg-primary">Submit form</button>
        </div>
      </form>
     </div>
    </div>
   </div>
  </div>
 </div>
</div>
@endsection
