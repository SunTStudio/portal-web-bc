@extends('component.navbar')

@section('content')

@include('component.message')

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>EHS Patrol</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('patrolEHS')}}">Table EHS Patrol</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{url('patrolEHS/'.$laporan->laporan_patrol->id)}}" >Detail Laporan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Detail Temuan</strong>
            </li>
        </ol>
    </div>
</div>

<div class="form-group row">

    <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Foto Temuan</h4>
                    <small>Foto dibuat pada tanggal @dateWithDay($laporan->created_at) oleh {{ $laporan->auditor->name }}</small>
                </div>
                <div class="modal-body" style="overflow: hidden;">
                    <div id="image-to-rotate1" class="ibox-content no-padding border-left-right">
                        <img alt="image" class="img-fluid" src="{{ asset('gambar/foto_temuan/'.$laporan->foto_temuan) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="rotate-button1" class="btn btn-white"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>


    <div class="modal inmodal" id="gambar_penanggulangan" tabindex="-1" role="dialog"  aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated fadeIn">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Foto Penanggulangan</h4>
                    <small>Penanggulangan berupa {{ $laporan->penanggulangan }} yang dikerjakan oleh {{ $laporan->PIC->name }} pada tanggal @dateWithDay($laporan->PIC_submit_at)</small>
                </div>
                <div class="modal-body" style="overflow: hidden;">
                    <div id="image-to-rotate2" class="ibox-content no-padding border-left-right">
                        <img alt="image" class="img-fluid" src="{{ asset('gambar/foto_penanggulangan/'.$laporan->foto_penanggulangan) }}" style="width: 100%; height: 100%; object-fit: cover;">
                    </div>
                </div>
                <div class="modal-footer">
                    <button id="rotate-button2" class="btn btn-white"><i class="fa fa-repeat" aria-hidden="true"></i></button>
                    <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</div>


<div class="wrapper wrapper-content animated fadeInRight">
<div class="row">
    <div class="col-lg-12">
        <div class="ibox ">
            <div class="ibox-title bg-info">
                <h5>Form Data</h5>
                {{-- <div class="ibox-tools">
                    <a class="" href="http://www.google.com">
                        <i class="fa fa-exclamation-circle" style="color:white"></i>
                    </a>
                </div> --}}
            </div>
            <div class="ibox-content">
                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Tanggal Patrol</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder="@dateWithDay($laporan->tanggal_patrol)" class="form-control"></div>
                        
                        <label class="col-sm-1 col-form-label">Nama EHS</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder="{{ $laporan->auditor->name }}" class="form-control"></div>

                    </div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Area</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder="{{ $laporan->area->name }}" class="form-control"></div>
                        
                        <label class="col-sm-1 col-form-label">PIC</label>
                        
                        <div class="col-sm-4"><input type="text" disabled="" placeholder="{{ $laporan->PIC->name }}" class="form-control"></div>
                        
                    </div>
                    @if ($laporan->wo != null)

                    <div class="form-group row mt-4">
                        <label class="col-lg-2 col-form-label">Need Support</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder="{{ $laporan->wo }}" class="form-control"></div>

                        <label class="col-lg-1 col-form-label">No.WO</label>

                        <div class="col-sm-4 "><input type="text" disabled="" placeholder="{{ $laporan->noWO }}" class="form-control"></div>
                        
                    </div>
                    @endif

                    <div class="hr-line-dashed"></div>
                    
                    <div class="form-group row" >
                        
                        <label class="col-lg-2 col-form-label">Temuan</label>
                        
                        <div class="col-sm-9"><textarea style="height:100px" type="text" disabled="" placeholder="{{ $laporan->temuan }}" class="form-control"></textarea></div>
                        
                    </div>
                    
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Foto Temuan</label>
                        
                        <div class="col-sm-4"><div class="custom-file">
                            <button class="btn btn-info" data-toggle="modal" data-target="#myModal4" type="button"><i class="fa fa-paste"></i> Lihat Foto</button>
                        </div>
                    </div>
                </div>
                
                <div class="hr-line-dashed"></div>
                <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Kategori</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder="{{ $laporan->kategori }}" class="form-control"></div>
                        
                        <label class="col-sm-1 col-form-label">RANK</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder="{{ $laporan->rank }}" class="form-control"></div>
                        
                    </div>
                    <div class="form-group row align-items-center">
                                            
                        <label class="col-lg-2 col-form-label">Due Date</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder= "@dateWithDay($laporan->deadline_date_awal)" class="form-control"></div>
                        
                        @if ($laporan->deadline_date_awal !== $laporan->deadline_date)
                            <label class="col-lg-1 col-form-label col-form-label" style="font-size: 0.7rem;">Due Date Lanjutan</label>
                            <div class="col-sm-4"><input type="text" disabled="" placeholder= "@dateWithDay($laporan->deadline_date)" class="form-control"></div>
                        @endif

                        
    
                    </div>
                    
                    
                    <div class="hr-line-dashed"></div>

                    @if($laporan->alasan_penolakan != null)

                    <div class="form-group row">

                        <label class="col-lg-2 col-form-label">Catatan Perbaikan Lanjutan</label>

                        <div class="col-sm-9"><textarea style="border: 3px solid red; margin: 2px;" type="text" disabled="" placeholder="{{ $laporan->alasan_penolakan }}" class="form-control"></textarea></div>

                    </div>

@endif

@if($laporan->penanggulangan != null)

                    <div class="form-group row">

                        <label class="col-lg-2 col-form-label">Penanggulangan</label>

                        <div class="col-sm-9"><textarea style="height:100px" type="text" disabled="" placeholder="{{ $laporan->penanggulangan }}" class="form-control"></textarea></div>

                    </div>

@endif

                @if($laporan->foto_penanggulangan != null)
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Foto Penanggulangan</label>

                <div class="col-sm-4">
                    <div class="custom-file">
                    <button class="btn btn-info" data-toggle="modal" data-target="#gambar_penanggulangan" type="button"><i class="fa fa-paste"></i> Lihat Foto</button>
                    </div>
                </div>
                </div>
                @endif
                    <div class="form-group row">

                        <label class="col-lg-2 col-form-label">Progress</label>
                        <div class="col-sm-9 mt-1">
                            <div class="progress progress-mini">
                                <div style="width: {{ ($laporan->progress * 10) }}%;" class="progress-bar"></div>
                            </div>
                                @if($laporan->progress <= 10) 

                            <div class="mt-2">{{ ($laporan->progress * 10) }}%</div>
                            @else 
                            <div class="mt-2">{{ (10 * 10) }}%</div>
                            @endif
                        </div>

                    </div>
                    
                    <div class="hr-line-dashed"></div>

                    <div class="form-group row">
                        <label class="col-lg-2 col-form-label">Tanggal Penanggulangan</label>

                        <div class="col-sm-4"><input type="text" disabled="" placeholder= "@if($laporan->PIC_submit_at != null)@dateWithDay($laporan->PIC_submit_at)
                                                                                            @else {{'-'}} @endif"  
                        class="form-control"></div>

                        <label class="col-lg-2 col-form-label">Verified Date</label>

                        <div class="col-sm-3"><input type="text" disabled="" 
                            placeholder= "@if($laporan->verify_submit_at != null) @dateWithDay($laporan->verify_submit_at)
                            @else {{ '-' }} @endif" 
                            class="form-control"></div>
                    </div>

                    <div class="hr-line-dashed"></div>
                    <div class="form-group row">
                        <label class="col-sm-2 col-form-label">Status Temuan</label>
                        
                        <div class="col-sm-4"><div class="custom-file">
                            <button class="btn btn-info" data-toggle="modal" data-target="#status_temuan" type="button"><i class="fa fa-paste"></i> Lihat Detail</button>
                        </div>
                    </div>

                    <div class="modal inmodal fade" id="status_temuan" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Status Temuan</h4>
                                </div>
                                <div class="modal-body">
                                    <div class="ibox-content">
                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">PIC </label>
                                            <div class="col-sm-4"><input type="text" disabled="" @if($laporan->PIC_id != null )placeholder="{{ $laporan->PIC->name }}"@else placeholder="-" @endif
                                            class="form-control"></div>
                                       
                                            <label class="col-lg-2 col-form-label">Submited</label>
                                       
                                            <div class="col-sm-3"><input type="text" disabled=""
                                                @if($laporan->PIC_submit_at != null )placeholder="@dateWithDay($laporan->PIC_submit_at)"@else placeholder="-" @endif
                                                class="form-control"></div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Department Head PIC</label>
                                            <div class="col-sm-4"><input type="text" disabled="" @if($laporan->dept_pic_id != null )placeholder="{{ $laporan->dept_PIC->name }}"@else placeholder="-" @endif
                                            class="form-control"></div>
                                       
                                            <label class="col-lg-2 col-form-label">Approved</label>
                                       
                                            <div class="col-sm-3"><input type="text" disabled=""
                                                @if($laporan->ACC_Dept_Head_PIC_At != null )placeholder="@dateWithDay($laporan->ACC_Dept_Head_PIC_At)"@else placeholder="-" @endif
                                                class="form-control"></div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">EHS</label>
                                            <div class="col-sm-4"><input type="text" disabled="" @if($laporan->verify_submit_at != null )placeholder="{{ $laporan->auditor->name }}"@else placeholder="-" @endif
                                            class="form-control"></div>
                                       
                                            <label class="col-lg-2 col-form-label">Verify</label>
                                       
                                            <div class="col-sm-3"><input type="text" disabled=""
                                                @if($laporan->verify_submit_at != null )placeholder="@dateWithDay($laporan->verify_submit_at)"@else placeholder="-" @endif
                                                class="form-control"></div>
                                        </div>


                                        <div class="form-group row">
                                            <label class="col-lg-2 col-form-label">Department Head EHS</label>
                                       
                                            <div class="col-sm-4"><input type="text" disabled="" @if($laporan->dept_ehs_id != null )placeholder="{{ $laporan->dept_EHS->name }}"@else placeholder="-" @endif class="form-control"></div>
                                       
                                            <label class="col-lg-2 col-form-label">Approved</label>
                                       
                                            <div class="col-sm-3"><input type="text" disabled="" @if($laporan->ACC_Dept_Head_EHS_At != null )placeholder="@dateWithDay($laporan->ACC_Dept_Head_EHS_At)"@else placeholder="-" @endif class="form-control"></div>
                                        </div>
                                    </div>
                                </div>


                                <div class="modal-footer">
                                    
                                    <button type="submit" class="btn btn-white" data-dismiss="modal">Close</button>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group row">



                        {{-- Pembagian tugas masing masing role --}}



                        <div class="col-7 col-sm-8 col-lg-9 col-sm-offset-2">
                            @if($laporan->deleted_at == null && $laporan->laporan_patrol->deleted_at == null)
                                @if($laporan->progress < 10) 

                                    @role(['EHS', 'Departement Head EHS'])
                                        <form id="submitForm" action="{{url('hapus-laporan')}}" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value={{ $laporan->id }}>
                                        <button class="btn btn-danger btn-sm" id="submitButton" type="submit">Cancel</button>
                                        </form>
                                        
                                        <a class="btn btn-warning btn-sm" href="{{url('editForm', ['id' => $laporan->id])}}" type="submit">Edit</a>
                                    @endrole

                                    @role(['PIC', 'Departement Head PIC'])
                                    @foreach($laporan->area->area as $DeptPIC)
                                            @if($DeptPIC->user_id == auth()->user()->id)
                                                <a class="btn btn-primary btn-sm" href="{{url('laporan_penanggulangan/'.$laporan->id)}}" type="submit">Update Perbaikan</a>
                                        @endif
                                    @endforeach
                                    @endrole

                                @elseif($laporan->progress == 10 && $laporan->ACC_Dept_Head_PIC_At == null )

                                    @role('PIC')
                                    
                                        @foreach($laporan->area->area as $DeptPIC)
                                            @if($DeptPIC->user_id == auth()->user()->id)
                                                
                                                
                                                <a class="btn btn-primary btn-sm" href="{{url('laporan_penanggulangan/'.$laporan->id)}}" type="submit">Update Perbaikan</a>    


                                                <form id="submitForm" action="{{route('needApproveTemuanPic')}}" method="post" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value="{{ $laporan->id }}">
                                                    <button class="btn btn-success btn-sm" id="submitButton" type="submit" >Kirim email minta approval depthead</button>
                                                </form>
                                            @endif
                                        @endforeach

                                    @endrole

                                    @role('Departement Head PIC')
                                        @foreach($laporan->area->area as $DeptPIC)
                                        
                                            @if($DeptPIC->user_id == auth()->user()->id)
                                            
                                                    <a class="btn btn-danger btn-sm text-white" href="{{ route('createPenolakan', ['id' => $laporan->id])}}">Tolak</a>
                                                    <form id="submitForm" action="{{ route('deptHeadPicSubmit')}}" method="post" class="inline">
                                                        @csrf
                                                        <input type="hidden" name="id" value={{ $laporan->id }}>
                        
                                                    <button class="btn btn-primary btn-sm" id="submitButton" type="submit">Approve</button>
                                                    </form>
                                            @endif
                                        @endforeach

                                    @endrole
                                
                                @elseif($laporan->progress == 11 && $laporan->ACC_Dept_Head_PIC_At !== null )
                                    
                                    @role('Departement Head PIC')
                                        @foreach($laporan->area->area as $DeptPIC)
                                            @if($DeptPIC->user_id == auth()->user()->id)
                                                <form id="submitForm" action="{{url('needVerifyEHS') }}" method="post" class="inline">
                                                    @csrf
                                                    <input type="hidden" name="id" value={{ $laporan->id }}>
                                                    <button class="btn btn-success btn-sm" id="submitButton" type="submit" >Kirim email minta approval EHS</button>
                                                </form>
                                            @endif
                                        @endforeach
                                    @endrole

                                    @role('EHS')
                                        <a class="btn btn-danger btn-sm text-white" href="{{ route('createPenolakan', ['id' => $laporan->id])}}">Tolak</a>

                                        <form id="submitForm" action="{{route('verify-laporan') }}" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" name="laporan_id" value={{ $laporan->id }}>
                                        <button class="btn btn-primary btn-sm" id="submitButton" href="{{route('editForm',['id' => $laporan->id]) }}" type="submit">Verifikasi</button>
                                        </form>
                                    @endrole
                                
                                @elseif($laporan->progress == 12 && $laporan->verify_submit_at !== null && $laporan->ACC_Dept_Head_EHS_At == null )
                                    
                                    @role('EHS')
                                    <form id="submitForm" action="{{route('needApproveTemuanPic')}}" method="post" class="inline">
                                        @csrf
                                        <input type="hidden" name="id" value={{ $laporan->id }}>
                                        <button class="btn btn-success btn-sm" id="submitButton" type="submit" >Kirim email minta approval depthead EHS</button>
                                    </form>
                                    @endrole

                                    @role('Departement Head EHS')
                                        <a class="btn btn-danger btn-sm text-white" href="{{ route('createPenolakan', ['id' => $laporan->id])}}">Tolak</a>
                                            <form id="submitForm" action="{{route('deptHeadEhsSubmit') }}" method="post" class="inline">
                                                @csrf
                                                <input type="hidden" name="laporan_id" value={{ $laporan->id }}>
                                            <button class="btn btn-primary btn-sm" id="submitButton" type="submit">Approve</button>
                                            </form>
                                    @endrole

                                @elseif($laporan->progress == 13 && $laporan->ACC_Dept_Head_EHS_At !== null)

                                    @role('Departement Head EHS')
                                        <form id="submitForm" action="{{url('ApprovedDeptHeadEHS') }}" method="post" class="inline">
                                            @csrf
                                            <input type="hidden" name="id" value={{ $laporan->id }}>
                                            <button class="btn btn-success btn-sm" id="submitButton" type="submit" >Kirim email notifikasi selesai temuan</button>
                                        </form>
                                    @endrole

                                @endif
                            @endif

                        </div> 
                                <div class="justify-content-end"> 
                                    <a class="btn btn-info btn-sm" href="{{url('patrolEHS/'.$laporan->laporan_patrol->id) }}" type="button">Lihat Laporan</a>
                                </div>
                    </div>

            </div>
        </div>
    </div>
</div>
</div>
@endsection