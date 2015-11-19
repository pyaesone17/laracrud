
@if($type=='edit')

	,Master

	Content

		<?php $model=strtolower($model).'s' ?>

		<form class="form-horizontal" method="Post" role="form" action=": route( '{{ $model.'.update' }}' ,['id' => $data->id] ) #">
   

       		<input type="hidden" name="_token" value="@{{ csrf_token() }}">
       		<input type="hidden" name="_method" value="PUT">

        	@foreach($fields as $field)

				<?php $output=$data.'-'.">".$field ?>

        		@if(in_array($field,$textareas))

				<div class="form-group">
					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10 ">

						<textarea class="form-control" name="text" cols="50" rows="10"  > : {!!  $output  !!} # </textarea>
        				
					</div>
				</div>

	       		@elseif($field=='email')

				<div class="form-group">
					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10 ">
						<input class="form-control" name="{{ $field }}" type="email" value=": {!!  $output  !!} #">
					</div>
				</div>

				@elseif($field=='password')
					
        		@else   

				<div class="form-group">

					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10 ">
						
	       				<input class="form-control" name="{{ $field }}" type="text" value=": {!!  $output  !!} #">
					</div>
				</div>

        		@endIf

        	@endforeach()

				<div class="form-group">
					<div class="col-sm-10">
						<input type="submit" value="Submit" class="btn btn-primary">
            			<input type="reset" value="Cancel" class="btn btn-primary">
            		</div>
        		</div>

       </form>

    StopCon

@elseif($type=='all')

	,Master

	Content

		<table class="table table-hover table-bordered" id="sample_editable_1"  >

			<thead>
				<tr>
					@foreach($fields as $field)
					
					@if($field=='password')
							
		        	@else

					<th>
						 {{ ucfirst($field) }}
					</th>

					@endIf

					@endforeach()

					<th>
						Edit
					</th>
						 
					
					<th>
						 Delete
					</th>
				</tr>
			</thead>
			<tbody>
			!!! ($datas as $data)
			<tr>
				@foreach($fields as $field)

				@if($field=='password')
						
	        	@else
				
				<td>
					<?php $output=$data.'-'.">".$field ?>

					 : {!!  $output  !!} #
				</td>

				@endIf 

				@endforeach()

				<td>
					<a class="edit" href=": url('{{strtolower($model)}}s'.'/'.$data->id).'/edit' # ">
					Edit </a>
				</td>

				<td>
					<a class="delete" data-id="">
					Delete </a>
				</td>
			</tr>
			
			=!!
			</tbody>

		</table>


	StopCon

@elseif($type=='show')

	,Master

	Content

		<div class="panel panel-primary">

		  <div class="panel-heading">

		    <h3 class="panel-title"> {{ ucwords($model) }} Info</h3>

		  </div>

		  <div class="panel-body">
		   		
					@foreach($fields as $field)
					
						@if($field=='password')

						@else
						<div class="row">
				        	<div class="col-lg-2">
								{{ ucfirst($field) }}
							</div>

							<div class="col-lg-10">
								<?php $output=$data.'-'.">".$field ?>

								 : {!!  $output  !!} #
							</div>

								

						</div>

						<br>

						@endIf

					@endforeach()
		   		

		   		
		  </div>

		</div>

	StopCon

@else

	,Master

	Content

		<?php $model=strtolower($model).'s' ?>

       <form class="form-horizontal" method="Post" role="form" action=": route( '{{ $model.'.store' }}' ) #">

        	<input type="hidden" name="_token" value="@{{ csrf_token() }}">

        	@foreach($fields as $field)


        		@if(in_array($field,$textareas))

				<div class="form-group">

					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10 ">
						<textarea class="form-control" name="text" cols="50" rows="10" ></textarea>
					</div>
				</div>

	       		@elseif($field=='email')

				<div class="form-group">
					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10 ">
					
						<input class="form-control" name="{{ $field }}" type="email">

					</div>
				</div>

				@elseif($field=='password')

				<div class="form-group">
					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10">
						<input class="form-control" name="{{ $field }}" type="password">
					</div>
				</div>

        		@else   

				<div class="form-group">
					<label class="col-sm-2">{{ ucwords($field) }}</label>
					<div class="col-sm-10 ">
						<input class="form-control" name="{{ $field }}" type="text">
					</div>
				</div>

        		@endIf

        	@endforeach()

				<div class="form-group">
					<div class="col-sm-10">

						<input type="submit" value="Submit" class="btn btn-primary">
            			<input type="reset" value="Cancel" class="btn btn-primary">
            		</div>
        		</div>

        </form>

    StopCon

@endIf





