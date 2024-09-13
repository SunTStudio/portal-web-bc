@extends('component.navbar')

@section('content')

@include('component.message')

@error('foto_temuan')
<div class="alert alert-danger">File bukti harus berbentuk gambar</div>
@enderror

<div class="row wrapper border-bottom white-bg page-heading">
    <div class="col-lg-10">
        <h2>EHS Patrol</h2>
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{url('patrolEHS')}}">Table EHS Patrol</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{url('patrolEHS/'.$laporan->id)}}">Detail Laporan</a>
            </li>
            <li class="breadcrumb-item active">
                <strong>Buat Temuan</strong>
            </li>
        </ol>
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
                <form id="submitForm" method="post" action="{{route('createFormStore')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="auditor_id" value={{ auth()->user()->id }}>
                    <input type="hidden" name="patrol_id" value={{ $laporan->id }}>
                    <input type="hidden" name="progress" value="0">
                    <input type="hidden" name="area_id" value={{ $laporan->area_id }}>
                    <input type="hidden" name="PIC_id" value={{ $PIC->user_id }}>

                    <div class="form-group row"><label class="col-sm-2 col-form-label">Temuan</label>

                        <div class="col-sm-10"><input type="text" class="form-control" name="temuan" value="{{ old('temuan') }}" required></div>
                    </div>
                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Bukti Foto</label>

                        <div class="col">
                            <div class="custom-file" style="display: flex; align-items: center;">
                              <div style="margin-right:0">
                                <input id="logo" type="file" class="custom-file-input" name="foto_temuan" required style="flex-grow: 1;">
                                <label for="logo" id="cameraLabel" class="custom-file-label" style="margin-right:0; white-space: nowrap;">Choose file or take picture</label>
                              </div>
                              
                            </div>
                          </div>
                    </div>
                    
                    <div class="hr-line-dashed"></div>
                    <div class="form-group row"><label class="col-sm-2 col-form-label" >Kategori</label>
                        <div class="col-sm-4">
                            <select class="select2_demo_3 form-control" name="kategori" required>
                                
                                <option></option>
                                <option value="5R" @if(old('kategori') == '5R') selected @endif>5R</option>
                                <option value="A" @if(old('kategori') == 'A') selected @endif>A</option>
                                <option value="B" @if(old('kategori') == 'B') selected @endif>B</option>
                                <option value="C" @if(old('kategori') == 'C') selected @endif>C</option>
                                <option value="D" @if(old('kategori') == 'D') selected @endif>D</option>
                                <option value="E" @if(old('kategori') == 'E') selected @endif>E</option>
                                <option value="F" @if(old('kategori') == 'F') selected @endif>f</option>
                                <option value="G" @if(old('kategori') == 'G') selected @endif>G</option>
                            </select>
                        </div>

                            <label class="col-sm-1 col-form-label">RANK</label>
                            <div class="col-sm-4">
                                <select class="select2_demo_3 form-control" name="rank" required>
                                    <option></option>
                                    <option value="A" @if(old('rank') == 'A') selected @endif>A</option>
                                    <option value="B" @if(old('rank') == 'B') selected @endif>B</option>
                                    <option value="C" @if(old('rank') == 'C') selected @endif>C</option>
                                </select>
                            </div>
                    </div>

                    <div class="form-group row">
                    <label class="col-sm-2 col-form-label">Due Date</label>
                            <div class="col-sm-4" id="data_3">
                                <div class="input-group date">
                                    <span class="input-group-addon"><i class="fa fa-calendar"></i></span><input type="text" class="form-control" name="deadline_date" value="{{ date('d/m/Y') }}">
                                </div>
                            </div>
                        </div>

                    <div class="hr-line-dashed"></div>

                    <div class="form-group row">
                        <div class="col-sm-4 col-sm-offset-2">
                            {{-- <!-- <a class="btn btn-white btn-sm" href="/patrolEHS/{{ $laporan->id }}">kembali</a> --> --}}
                            <a class="btn btn-white btn-sm" href="{{ route('patrolEhsDetail', ['id' => $laporan->id]) }}">Kembali</a>
                            <button id="submitButton" class="btn btn-primary btn-sm" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

@endsection