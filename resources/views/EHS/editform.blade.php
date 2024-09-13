@extends('component.navbar')

@section('content')

@include('component.message')
<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>EHS Patrol</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{route('patrolEhs')}}">Table EHS Patrol</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('patrolEhsDetail', ['id' => $laporan->laporan_patrol->id])  }}" >Detail Laporan</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('detailLaporan', ['id' => $laporan->id])  }}" >Detail Temuan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Edit Temuan</strong>
            </li>
        </ol>
    </div>
</div>

@error('foto_temuan')
<div class="alert alert-danger">File bukti harus berbentuk gambar</div>
@enderror
<div class="modal inmodal fade" id="myModal5" tabindex="-1" role="dialog"  aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title">Foto Temuan</h4>
            </div>
            <div class="modal-body">
                <div id="cameraOutput"></div>
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
            </div>
            <div class="ibox-content">
                <form id="submitForm" method="post" action="{{route('updateForm')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value={{ $laporan->id }}>
                    <input type="hidden" name="auditor_id" value={{ auth()->user()->id }}>
                    <input type="hidden" name="PIC_id" value={{ $laporan->PIC_id }}>
                    <input type="hidden" name="area_id" value={{ $laporan->area_id }}>
                    {{-- @livewire('form-area-p-i-c', ['genba_area' => $laporan->area_id, 'selectdisable' => true])
                    @stack('scripts') --}}
                    
                    {{-- <div class="hr-line-dashed"></div> --}}
                    <div class="form-group row"><label class="col-sm-2 col-form-label">Temuan</label>

                        <div class="col-sm-10"><input type="text" class="form-control" name="temuan" value="{{ $laporan->temuan }}" required></div>
                    </div>

                    <div class="form-group row"><label class="col-sm-2 col-form-label">Bukti Foto</label>
                    
                        <div class="col-sm-7">
                            <div class="custom-file" style="display: flex; align-items: center;">
                                <div style="margin-right:0">
                                  <input id="logo" type="file" class="custom-file-input" name="foto_temuan" style="flex-grow: 1;">
                                  <label for="logo" id="cameraLabel" class="custom-file-label" style="margin-right:0; white-space: nowrap;">Choose file or take picture</label>
                                </div>
                                
                              </div>
                        </div>
                        

                    <div class="col-sm-1">
                        <button class="btn btn-info mt-3 mt-sm-0" data-toggle="modal" data-target="#myModal4" type="button"><i class="fa fa-paste"></i>Preview Sebelumnya</button>
                    </div>
                    

                    <div class="modal inmodal" id="myModal4" tabindex="-1" role="dialog"  aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content animated fadeIn">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                                    <h4 class="modal-title">Bukti Foto</h4>
                                    <small>Foto dibuat pada tanggal {{ $laporan->created_at }} oleh {{ $laporan->auditor->name }}</small>
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
                </div>
                
                <div class="hr-line-dashed"></div>

                    <div class="form-group row"><label class="col-sm-2 col-form-label" >Kategori</label>
                        <div class="col-sm-4">
                            <select class="select2_demo_3 form-control" name="kategori" required>
                                <option></option>
                                <option value="5R" @if($laporan->kategori == "5R") selected @endif>5R</option>
                                <option value="A" @if($laporan->kategori == "A") selected @endif>A</option>
                                <option value="B" @if($laporan->kategori == "B") selected @endif>B</option>
                                <option value="C" @if($laporan->kategori == "C") selected @endif>C</option>
                                <option value="D" @if($laporan->kategori == "D") selected @endif>D</option>
                                <option value="E" @if($laporan->kategori == "E") selected @endif>E</option>
                                <option value="f" @if($laporan->kategori == "F") selected @endif>f</option>
                                <option value="G" @if($laporan->kategori == "G") selected @endif>G</option>
                                <option value="O" @if($laporan->kategori == "O") selected @endif>O</option>
                            </select>
                        </div>

                            <label class="col-sm-1 col-form-label">RANK</label>
                            <div class="col-sm-4">
                                <select class="select2_demo_3 form-control" name="rank" required>
                                    <option></option>
                                    <option value="A" @if($laporan->rank == "A") selected @endif>A</option>
                                    <option value="B" @if($laporan->rank == "B") selected @endif>B</option>
                                    <option value="C" @if($laporan->rank == "C") selected @endif>C</option>
                                </select>
                            </div>
                    </div>

                    <div class="hr-line-dashed"></div>

                    
                <div class="form-group row">
                <label class="col-sm-2 col-form-label">Due Date</label>
                        <div class="col-sm-4" id="data_1">
                            <div class="input-group date">
                                <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="deadline_date" value="@dateWithDay($laporan->deadline_date)">
                            </div>
                        </div>
                </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            <a class="btn btn-white btn-sm" href="{{ route('detailLaporan', ['id' => $laporan->id]) }}" type="submit">Cancel</a>
                            <button id="submitButton" class="btn btn-warning btn-sm" type="submit">Save Changes</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
@endsection