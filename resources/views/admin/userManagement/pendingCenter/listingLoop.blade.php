@foreach($listing->items() as $index => $row)
<tr>
    <td>
        <span class="badge badge-dot mr-4">
            <i class="bg-warning"></i>
            <span class="status">{{ $index + 1 }}</span>  {{-- Row Number --}}
        </span>
    </td>
    <td>{{ $row->title ?? '' }}(<b>{{ $row->username ?? '' }}</b>)
        <br>Email: <b>{{ $row->email ?? '' }}</b>
    </td>
    <td>{{ $row->phone ?? 'N/A' }}</td>
    <td>{{ $row->states->name ?? 'N/A' }}</td>
    <td>{{ $row->city ?? 'N/A' }}</td>
    <td>{{ $row->status == 1 ? 'Approved' : 'Pending' }}</td>
    <td>2025-01-07 16:38:29</td>

    <td>                              
        <a data-toggle="modal" alt="Remarks" data-target="#myModal56522" href="javascript:;"><i class="fa fa-edit fa-2x"></i></a>
        <div id="myModal56522" class="modal fade" role="dialog">
        <div class="modal-dialog"> 
          <div class="modal-content">
        <div class="modal-header bg-primary">  
            <h4 class="modal-title">Center - RAJESWARI ITI SOLAR ACADEMY  MTC</h4>
            <button type="button" class="close" data-dismiss="modal">×</button>
        </div>
        <form action="" method="post" onsubmit="return validCenterApproval(56522)">
        <div class="modal-body">
          <div style="display:inline-block; width:100%">
            <div class="form-group col-md-12"> 
                <table class="table table-bordered table-striped">
                    <tbody><tr>
                        <th width="40%">Head Office :</th>
                        <td>Ch Rajpal Singh Memorial Sanstha</td>
                    </tr>
                    <tr>
                        <th>EmailId :</th>
                        <td>rajeshwariitisolaracademy.mtc@gmail.com</td>
                    </tr>
                    <tr>
                        <th>Address :</th>
                        <td>Raj Rajeswari ITI meerut Road Mawana Tehsil-Mawana District-Meerut Uttar Pradesh Pin Code-250401</td>
                    </tr>
                    <tr>
                        <th>State   :</th>
                        <td>UTTAR PRADESH</td>
                    </tr>
                    <tr>
                        <th>City    :</th>
                        <td>UTTAR PRADESH</td>
                    </tr>
                    <tr>
                        <th>Contact    :</th>
                        <td>8899867621</td>
                    </tr>
                    <tr>
                        <th>Academic Session    :</th>
                        <td>2024-2025</td>
                    </tr>
                    <tr>
                        <th>Center Afflilation From    :</th>
                        <td>28-Apr-2024</td>
                    </tr>
                    <tr>
                        <th>Center Afflilation Till    :</th>
                        <td>27-Apr-2025</td>
                    </tr>
                     <tr>
                        <th>SIP Registration ID     :</th>
                        <td>TP156032</td>
                    </tr>
                    <tr>
                        <td>Center Afflilation    :<a target="_blank" href="https://suryamitra.nise.res.in/uploads/certificates/956a45a0bc4fa364ea8543f7c5402629.pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a> </td>
                        <td>Trainer Certificate :<a target="_blank" href="https://suryamitra.nise.res.in/uploads/certificates/1d7d344bf6bd39aa9f16c7c0a8cd1f3c.pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a> </td>
                    </tr>
                    <tr>
                        <td>Proof of registration on AEBAS portal   :<a target="_blank" href="https://suryamitra.nise.res.in/uploads/certificates/4ff5b8a3a0c9a7d31ebd9424b5fb50f2.pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a> </td>
                        <td>CCTV Camera's Login Details :<a target="_blank" href="https://suryamitra.nise.res.in/uploads/certificates/56b61e4c15261c1398bfe7ed5b0c4518.pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a> </td>
                    </tr>
                    <tr>
                    <th>Proof of advertisement for mobilisation of participants</th>
                        <td>:<a target="_blank" href="https://suryamitra.nise.res.in/uploads/certificates/a11399317f9b2aa01c2052ff6e204ad5.pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a> </td>
                    </tr>
                     <tr>
                    <th>Proof of registration on SIP portal</th>
                        <td>:<a target="_blank" href="https://suryamitra.nise.res.in/uploads/certificates/f6b68065120cc950f206295b94f21cea.pdf"><i class="fa fa-file-pdf-o fa-2x text-danger"></i></a> </td>
                    </tr>
                    
                </tbody></table>
            </div>
           
            <div class="form-group col-md-12"> 
            <label>Remark <span class="text-danger">*</span></label>
            <textarea name="statusRemark" id="statusRemark56522" rows="5" class="form-control" placeholder="Enter address here..." style="width:100%"></textarea>
            </div>
            <div class="form-group col-md-12"> 
            <label>Status <span class="text-danger">*</span></label>
            <select name="status" id="status56522" class="form-control" style="width:100%">
              <option value="">~~~~~~~Select Status~~~~~~~</option>
              <option value="Approved">Approved</option>
              <option value="Rejected">Reject</option>
            </select>
            </div>
            
          </div>
            </div>
        <div class="modal-footer">
         <input type="hidden" name="csrf" value="CB7Se7ty9iLrpNKy37mGa8gYQ6ySQD0FOn4">
         <input type="hidden" name="id" value="YTJjOTQwMzdjNDA4M2JmOGM5YTk1ZmM0MzY5ZjNhNDJ8MzMzMjUzNzEy">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          <button type="submit" name="approve" class="btn btn-primary">Submit</button>
        </div>
       </form>
      </div>
        </div>
    </div>
    </td>
</tr>
@endforeach
