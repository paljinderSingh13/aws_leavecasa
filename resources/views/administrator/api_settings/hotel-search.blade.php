@extends('layouts.main')
@section('content')
    <!--CONTENT CONTAINER-->
    <!--===================================================-->
    <div id="content-container">
        <div id="page-head">
            
            <!--Page Title-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <div id="page-title">
                <h1 class="page-header text-overflow">Search Hotels</h1>
            </div>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End page title-->


            <!--Breadcrumb-->
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <ol class="breadcrumb">
            <li><a href="#"><i class="demo-pli-home"></i></a></li>
            <li><a href="#">Blog</a></li>
            <li class="active">Search Hotels</li>
            </ol>
            <!--~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~-->
            <!--End breadcrumb-->

        </div>

        
        <!--Page content-->
        <!--===================================================-->
        <div id="page-content">
            
                 <!-- Search -->
                 <!--===================================================-->
                <div class="row pad-btm">
                    <form action="#" method="post" class="col-xs-12 col-sm-10 col-sm-offset-1 pad-hor">
                        <div class="input-group mar-btm">
                             <input type="text" placeholder="Search posts..." class="form-control input-lg">
                             <span class="input-group-btn">
                                 <button class="btn btn-primary btn-lg" type="button">Search</button>
                             </span>
                        </div>
                    </form>
                </div>
            

                <div class="panel">
                    <div class="panel-body">
                        <h3>Search Your Hotel</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Beatae, eum, magni nesciunt soluta labore dolorem expedita ipsa asperiores temporibus suscipit maxime harum odit autem dolor recusandae impedit itaque adipisci rem..</p>
                        <form action="" method="POST">
                            {{ csrf_field() }}
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Destination</label>
                                                <input type="text" class="form-control" name="destination" placeholder="Exp: DEL" value="C!000555" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Check In Date</label>
                                                <input type="text" class="form-control" name="to" placeholder="DD-MM-YYYY" value="2018-03-30" readonly>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Check Out Date</label>
                                                <input type="text" class="form-control" name="to" placeholder="DD-MM-YYYY" value="2018-04-05" readonly>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <button class="btn btn-success" type="submit" style="margin-top: 8.5%;">Search Now</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>  


                 <!-- Toolbar -->
                 <!--===================================================-->
                {{-- <div class="pad-all text-center">
                    <div class="box-inline mar-btm pad-rgt">
                         Only in categories :
                         <div class="select">
                             <select id="demo-ease">
                                 <option value="internet" selected="">Internet</option>
                                 <option value="musics">Musics</option>
                                 <option value="sports">Sports</option>
                                 <option value="tutorials">Tutorials</option>
                                 <option value="movies">Movies</option>
                             </select>
                         </div>
                    </div>
                    <div class="box-inline mar-btm">
                         Sort by :
                         <div class="select">
                             <select id="demo-ease">
                                 <option value="date-created" selected="">Date Created</option>
                                 <option value="date-modified">Date Modified</option>
                                 <option value="frequency-used">Frequency Used</option>
                                 <option value="alpabetically">Alpabetically</option>
                                 <option value="alpabetically-reversed">Alpabetically Reversed</option>
                             </select>
                         </div>
                    </div>
                    <button class="btn btn-default">Filter</button>
                </div> --}}
            
                <hr class="new-section-xs bord-no">
            
                <div class="panel">
            
                    <!--Posts Table-->
                    <!--===================================================-->
                    @if(!empty($results))
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-vcenter">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Hotel Name</th>
                                            <th>Facilities</th>
                                            <th>Price</th>
                                            <th class="text-center">Tracking Number</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($results['hotels'] as $key => $hotel)
                                            <tr>
                                                <td><img class="img-responsive img-sm" src="{{ $hotel['images']['url'] }}" alt="thumbs"></td>
                                                <td><a class="btn-link" href="#">{{ $hotel['name'] }}</a></td>
                                                @php
                                                    $facilities = explode(';',$hotel['facilities']);
                                                @endphp
                                                <td>
                                                    {{ $facilities[0] }} | 
                                                    {{ $facilities[1] }}
                                                </td>
                                                <td><a href="#" class="btn-link">₹ {{ $hotel['rates'][0]['price'] }}</a></td>
                                                <td class="min-width">
                                                    <div class="btn-groups">
                                                        <a href="#" class="btn btn-icon demo-pli-gear icon-lg add-tooltip" data-original-title="Settings" data-container="body"></a>
                                                        <a href="#" class="btn btn-icon demo-pli-file-text-image icon-lg add-tooltip" data-original-title="View post" data-container="body"></a>
                                                        <a href="#" class="btn btn-icon demo-pli-pen-5 icon-lg add-tooltip" data-original-title="Edit Post" data-container="body"></a>
                                                        <a href="#" class="btn btn-icon demo-pli-trash icon-lg add-tooltip" data-original-title="Remove" data-container="body"></a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-sm-5">
                                    <div>Showing 1 to 10 of 57 entries</div>
                                </div>
                                <div class="col-sm-7 text-right">
                                    <ul class="pagination">
                                        <li class="disabled"><a href="#" class="demo-pli-arrow-left"></a></li>
                                        <li class="active"><a href="#">1</a></li>
                                        <li><a href="#">2</a></li>
                                        <li><a href="#">3</a></li>
                                        <li><a href="#">4</a></li>
                                        <li><span>...</span></li>
                                        <li><a href="#">20</a></li>
                                        <li><a href="#" class="demo-pli-arrow-right"></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    @endif
                    <!--===================================================-->
                    <!--End Posts Table-->
            
            
            
                    
        </div>
        <!--===================================================-->
        <!--End page content-->

    </div>
    <!--===================================================-->
    <!--END CONTENT CONTAINER-->
@endsection