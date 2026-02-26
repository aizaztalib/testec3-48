 {{-- resources/views/Admin/Contacts/teachers.blade.php --}}

<!-- ---------------contact-wrap--------------- -->
@extends('Admin.base')
@section('body')
    <section class="tcommon contact-wrap table" style="background-color:#F3F9F9!important; padding-bottom:50px!important;">
        <div class="container-fluid contact-tabs">
            <div class="row">
                <div class="col-12">
                    <input type="hidden" name="type" id="type" value="{{ $type ?? '' }}" />
                    <input type="hidden" name="absent_date" id="absent_date" value="{{ $absent_date ?? '' }}" />
                    <input type="hidden" id="checked_value">

                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h2 class="header-title">Teachers</h2>
                            <ol class="breadcrumb" style="background-color: #f8f9fa;">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}">Dashboard</a></li>
                                <li class="breadcrumb-item " aria-current="page">Teachers</li>
                            </ol>
                        </div>
                        <form action="" id="wordCountForm">
                            <div class="total-album-box m-0">
                                <select id="contact_date" id="date" class="contact_date" name="date"
                                    style="height: 45px;
                                       border: 1px solid #ced4da;
                                       border-radius: 5px;
                                       min-width: 133px;
                                       padding: 10px;
                                       display: flex;
                                       margin: 0 0 20px auto;">
                                    <?php
                                    // $selectedyear = 2024;
                                    $selectedyear = '';
                                    if (request('date') != '') {
                                        $selectedyear = request('date');
                                    }
                                    
                                    ?>
                                    <option value="">All</option>
                                    @for ($years = 2000; $years <= date('Y'); $years++)
                                        <option @if ($selectedyear == $years) selected @endif
                                            value="{{ $years }}">{{ $years }}</option>
                                    @endfor
                                </select>
                                <!-- <button class="btn btn-primary" style="background-color:#51acad;" type="submit">Search</button> -->
                            </div>
                        </form>
                    </div>
                    <div class="add_child_staff">
                        <div id="buttonContainer" class="d-flex justify-content-end">
                            <!-- Button for adding staff -->
                            <a href="{{ route('classroom/addstaff') }}" class="btn btn-outline-secondary m-0 staffbtn"
                                style="color: white;">
                                <i class="fa fa-plus" aria-hidden="true"></i> Add Staff
                            </a>
                        </div>


                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist" style="border: none;
    gap: 50px;">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-home" type="button" role="tab"
                                    aria-controls="pills-home" aria-selected="true"><i
                                        class="fas fa-chalkboard-teacher" style="margin-right:10px;"></i> Contact</button>
                            </li>

                            <li class="nav-item" role="presentation">
                              <button class="nav-link attendanceclicktab" id="attendance-tab1" data-bs-toggle="pill"
                                  data-bs-target="#attendance-tab" type="button" role="tab" aria-controls="attendance-tab"
                                  aria-selected="false"><i class="fas fa-book-reader"></i> Attendance </button>
                          </li>
          
                          <li class="nav-item" role="presentation">
                              <button class="nav-link leavesclicktab" id="leaves-tab" data-bs-toggle="pill"
                                  data-bs-target="#eval" type="button" role="tab" aria-controls="eval"
                                  aria-selected="false"><i class="fas fa-star-half-alt"
                                      style="font-size: 20px;"></i> Leaves</button>
                          </li>
                        </ul>
                    </div>
                    <div class="tab-content" id="pills-tabContent">
                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel"
                            aria-labelledby="pills-home-tab">
                            <div class="container-fluid table-contain">
                                <div class="row">
                                    <div class="choose-action">
                                        <select id="graduted" class="form-control btnactive">
                                            <option selected value="1" class="dropdown-item">Active</option>
                                            <option value="0" class="dropdown-item">Inactive</option>
                                        </select>

                                        <div class="search-box">
                                            <input type="text" id="teacher_search" class="form-control" placeholder="Search teachers...">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row mb-2 stu outer-dashbox">
                                <div class="col-md-3">
                                    <div class="dashboard-box filter-btn" data-filter="all">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/students.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <div class="dashboard-teext">
                                            <p>Total Teachers</p>
                                            <p class="bold m-0">{{ $totalStaffCount ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dashboard-box filter-btn" data-filter="present">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/published.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <div class="dashboard-teext">
                                            <p>Present Teachers</p>
                                            <p class="bold m-0">{{ $presentStaffCount ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dashboard-box filter-btn" data-filter="absent">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/pending.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <div class="dashboard-teext">
                                            <p>Absent Teachers</p>
                                            <p class="bold m-0">{{ $absentStaffCount ?? 0}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dashboard-box">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/portfolio.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <a href="javascript::void(0);">
                                            <div class="dashboard-teext">
                                                <p>Apply Leave</p>
                                                <p class="bold m-0">{{ $appliedLeavesCount ?? 0}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            {{-- <div class="container-fluid table-contain">
                                <div class="row">
                                    <div class="col-md-12 cont">
                                        <div style="display: flex; justify-content: space-between; align-items: center;">
                                        </div>
                                        <input type="hidden" id="checked_value">

                                    </div>

                                    <div class="choose-action">
                                        <select id="btn-dd" class="form-control" style="display:none;">
                                            <option value="" class="dropdown-item">Choose Class</option>
                                            @foreach ($classes->school_classes as $class)
                                                <option value="{{ $class->id }}" class="dropdown-item">
                                                    {{ $class->name }}</option>
                                            @endforeach
                                        </select>

                                        <select id="graduted" class="form-control btnactive">
                                            <option selected value="1" class="dropdown-item">Active</option>
                                            <option value="2" class="dropdown-item">Graduated</option>

                                        </select>

                                    </div>
                                    <div class="col-md-12">
                                        
                                        <div class="table_contacts-section">
                                            
                                            <table class="table table-striped data-table">
                                                <thead>
                                                    <tr style="background: #fff; color: #000;">
                                                        <th scope="col">Profile</th>
                                                        <th scope="col">Class</th>
                                                        <!-- <th scope="col">Address</th> -->
                                                        <th scope="col">Contact 1</th>
                                                        <!-- <th scope="col">Contact 2</th> -->
                                                        <th scope="col" class="check_td">
                                                            <!-- <div class="custom-control custom-switch"> -->
                                                            <input style="margin-right: 10px; width:20px; height:20px;"
                                                                type="checkbox" id="checkboxClickAll"
                                                                class="checkboxClickAll">All
                                                            <!-- <label class="custom-control-label" for="checkboxClickAll"></label> -->
                                                            <!-- </div> -->
                                                        </th>



                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                        <div class="tab-pane fade  show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                            <div class="container-fluid table-contain">
                               <div class="row">
                                  <div class="col-md-12">
                                     <div class="table_contacts-section">
                                        <table class="table table-striped data-tablestaff">
                                           {{--  <input type="text" id="email_search" placeholder="Search by email">  --}}
             
                                           <thead>
                                              <tr style="background: #fff; color: #000;">
                                                 <th scope="col" style="width: 30%;">Name</th>
                                                 {{--  <th scope="col">Email</th>  --}}
                                                 <th scope="col" style="width: 30%;">Assigned Class</th>
                                                 <th scope="col" style="width: 20%;">Contact</th>
                                                 <!-- <th scope="col">Schedule</th>
                                                 <th scope="col">DOB</th> -->
                                                 <th scope="col" style="width: 20%;">Action</th>
                                              </tr>
                                           </thead>
                                        </table>
                                     </div>
                                  </div>
                               </div>
                            </div>
                         </div>

                        {{-- Attendance Tab --}}
                        <div class="tab-pane fade" id="attendance-tab" role="tabpanel" aria-labelledby="attendance-tab1">
                            <div class="row mb-2 stu outer-dashbox">
                                <div class="col-md-3">
                                    <div class="dashboard-box filter-btn" data-filter="all">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/students.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <div class="dashboard-teext">
                                            <p>Total Teachers</p>
                                            <p class="bold m-0">{{ $totalStaffCount ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dashboard-box filter-btn" data-filter="present">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/published.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <div class="dashboard-teext">
                                            <p>Present Teachers</p>
                                            <p class="bold m-0">{{ $presentStaffCount ?? 0 }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dashboard-box filter-btn" data-filter="absent">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/pending.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <div class="dashboard-teext">
                                            <p>Absent Teachers</p>
                                            <p class="bold m-0">{{ $absentStaffCount ?? 0}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="dashboard-box">
                                        <div class="dashboard-icon">
                                            <img src="{{ asset('public/images/classroom/portfolio.png')}}" class="img-fluid" width="40px;">
                                        </div>
                                        <a href="javascript::void(0);">
                                            <div class="dashboard-teext">
                                                <p>Apply Leave</p>
                                                <p class="bold m-0">{{ $appliedLeavesCount ?? 0}}</p>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <article class="child-section">
                                <div class="message"></div>
                                <div class="outer-tablebox" id="teacher_section">
                                    <table class="table teacher__staff-section">
                                        <thead>
                                            <tr class="outsearch">
                                                <th width="40%">Sent To</th>
                                                <th width="40%">Status</th>
                                                <th width="20%">Check-in/out</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if($teachers != null)
                                            @foreach ($teachers as $teacher)
                                            <tr data-status="{{ $teacher->staff_attendance == null ? 'absent' : 'present' }}">
                                                <th data-th="Sent To" width="40%">
                                                   
                                                    @if($teacher->active == 1)
                                                            <img style="height:50px;width:50px;border-radius:100%; margin-right:15px;"
                                                            src="{{ !empty($teacher->image) ? asset($teacher->image) : url('public/images/profile.jpg') }}">
                                                        {{$teacher->name}} <span class="badge">{{$teacher->role_id == 7 ? "Supervisor" : ''}}</span>
                                                    @else
                                                    <span class="img-span "><a
                                                        href=""><img
                                                            style="height:50px;width:50px;border-radius:100px;"
                                                            src="" /></a><span
                                                        class="date-span">Inactive
                                                        {{ date('jS M Y', strtotime($teacher->updated_at)) }}</span><a
                                                        href="" style="padding-left: 20px;">{{ $teacher->name }}</a></span>
                                                    @endif
                                                </th>
                                               
                                                <td data-th="Status" width="40%">
                                                    @if ($teacher->teacher_leaves)
                                                        <p class="child-status present" style="color: #2e00d1; background: #d6d5ff;">Leave</p>
                                                    @else
                                                        @if($teacher->staff_attendance == null)
                                                        <p class="child-status not-present">Not Present</p>
                                                        @elseif ($teacher->staff_attendance->time_in != null)
                                                        <p class="child-status present">Present</p>
                                                        @endif
                                                    @endif
                                                </td>
                                                <td width="20%" class="text-center">
                                                    <div class="d-flex align-items-center" style="gap: 15px">
                                                        <a href="javascript:;" style="width: 45%;" onclick="myfunctionAttendance({{@$teacher->id}}, 1, '{{@$teacher->staff_attendance->time_in ?? null}}');">
                                                            <span class="d-flex align-items-center justify-content-between px-3 py-1" style="gap: 10px; color: rgb(190, 190, 190); min-width: 6rem; border: 1px solid #dadada; border-radius: 4px">
                                                                {{isset($teacher->staff_attendance->time_in) ? date('h:i A', strtotime($teacher->staff_attendance->time_in)) : '00:00'}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0" />
                                                                        <path d="M12 7v5l3 3" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                        <a href="javascript:;" style="width: 45%;" onclick="myfunctionAttendance({{@$teacher->id}}, 2, '{{@$teacher->staff_attendance->time_out ?? null}}');">
                                                            <span class="d-flex align-items-center justify-content-between px-3 py-1" style="gap: 10px; color: rgb(190, 190, 190); min-width: 6rem; border: 1px solid #dadada; border-radius: 4px">
                                                                {{isset($teacher->staff_attendance->time_out) ? date('h:i A', strtotime($teacher->staff_attendance->time_out)) : '00:00'}}
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24">
                                                                    <g fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2">
                                                                        <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0-18 0" />
                                                                        <path d="M12 7v5l3 3" />
                                                                    </g>
                                                                </svg>
                                                            </span>
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                            @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </article>
                        </div>

                        {{-- Leaves Tab --}}
                        <div class="tab-pane fade" id="eval" role="tabpanel" aria-labelledby="leaves-tab">
                            <div class="enrollment__section-table bg-white" style="border-radius:5px">
                                <div class="row m-0" style="background: white; border-radius: 5px;">
                                    <div class="col-md-8">
                                        <div class="left d-flex">
                                        </div>
                                        <div class="tab-buttons tabs-outer">
                                            <button class="tab-button active" id="leaves-list-tab" onclick="openLeavesTab('list')"><i class="fas fa-list-ul"></i> List View</button>
                                            <button class="tab-button" id="leaves-calendar-tab" onclick="openLeavesTab('calendar')"> <i class="far fa-calendar-alt"></i>Calendar</button>
                                        </div>
                                    </div>

                                    @php
                                        $selectedMonth = request()->query('date') ? request()->query('date') : null;
                                    @endphp               
                                    <div class="col-md-4" id="leaves-calendar-controls" style="display: none;">
                                        <div class="form-group summary">
                                            <div class="stuyear" style="display: flex;
                                                border: 1px solid #ced4da;
                                                border-radius: 5px;
                                                padding: 10px;
                                                gap: 10px;
                                                height: 51px;">
                                                <select class="student_dob_year" name="student_dob_year" onchange="dateShowLeaves(this.value)">
                                                    <option value="">Select Month</option>
                                                    <option value="01" {{ $selectedMonth == '01' ? 'selected' : '' }}>January</option>
                                                    <option value="02" {{ $selectedMonth == '02' ? 'selected' : '' }}>February</option>
                                                    <option value="03" {{ $selectedMonth == '03' ? 'selected' : '' }}>March</option>
                                                    <option value="04" {{ $selectedMonth == '04' ? 'selected' : '' }}>April</option>
                                                    <option value="05" {{ $selectedMonth == '05' ? 'selected' : '' }}>May</option>
                                                    <option value="06" {{ $selectedMonth == '06' ? 'selected' : '' }}>June</option>
                                                    <option value="07" {{ $selectedMonth == '07' ? 'selected' : '' }}>July</option>
                                                    <option value="08" {{ $selectedMonth == '08' ? 'selected' : '' }}>August</option>
                                                    <option value="09" {{ $selectedMonth == '09' ? 'selected' : '' }}>September</option>
                                                    <option value="10" {{ $selectedMonth == '10' ? 'selected' : '' }}>October</option>
                                                    <option value="11" {{ $selectedMonth == '11' ? 'selected' : '' }}>November</option>
                                                    <option value="12" {{ $selectedMonth == '12' ? 'selected' : '' }}>December</option>
                                                </select>
                                            </div>
                                            <form id="leavesSearchForm" action=''>
                                                <input type="text" class="form-control" style="height:50px" name="name" placeholder="Search" value="{{request('name')}}" onkeyup="submitLeavesFormWithDelay()" />
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="leaves-list-view" class="leaves-view active">
                                <div class="col-md-12 summary-box bg-white">
                                    <div class="container-fluid">
                                        <div class="row">
                                            <div class="col-md-12 p-0">
                                                <div class="sidebar widget">
                                                    <ul id="leaves_section">
                                                    @if(isset($leaves[0]))
                                                    @for($l=0;$l<count($leaves);$l++)
                                                        <li class="out_contents">
                                                            <div class="content">
                                                                <div class="sidebar-thumb">
                                                                @php
                                                                $startDate = date_create($leaves[$l]->start_date);
                                                                $endDate = date_create($leaves[$l]->end_date);
                                                                $diff = date_diff($startDate, $endDate);

                                                                if($diff->days == 0){
                                                                    if($leaves[$l]->duration == 'full_day'){
                                                                        $totalDays = $diff->days + 1;
                                                                    }else{
                                                                        $totalDays = 0.5;
                                                                    }
                                                                }else{
                                                                    $totalDays = $diff->days + 1;
                                                                }

                                                                $report = $leaves[$l]->reports;
                                                                $extension = pathinfo($report, PATHINFO_EXTENSION);
                                                                
                                                                if (in_array(strtolower($extension), ['jpg', 'jpeg', 'png', 'gif'])) {
                                                                    $isImage = 1;
                                                                    $image = url($leaves[$l]->reports);
                                                                    $file = url($leaves[$l]->reports);
                                                                } elseif (strtolower($extension) === 'pdf') {
                                                                    $isImage = 2;
                                                                    $image = url('images/pdficon.jpeg');
                                                                    $file = url($leaves[$l]->reports);
                                                                } else {
                                                                    $isImage = 3;
                                                                    $image = url($leaves[$l]->reports);
                                                                    $file = url($leaves[$l]->reports);
                                                                }
                                                                @endphp
                                                            </div>
                                                            <!-- .Sidebar-thumb -->
                                                            <div class="sidebar-content">
                                                                <div class="d-flex text-white event-top justify-content-between">
                                                                    <div class="dates-time d-flex">
                                                                        <p class="m-0"><i class="far fa-calendar"></i>{{date_format(date_create($leaves[$l]->start_date),'d M Y')}} </p>
                                                                        <p class="m-0">- {{date_format(date_create($leaves[$l]->end_date),'d M Y')}}</p>
                                                                    </div>
                                                                    @if(isset($leaves[$l]->reports) && $leaves[$l]->reports !="")
                                                                    <div class="events">
                                                                        <p><i class="far fa-folder-open"></i><a href="javascript:void(0)" onclick="myfunction('{{ $leaves[$l]->notes }}', '{{$image}}','{{$isImage}}','{{$file}}')" style="color:white">Attachment</a></p>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                                <div class="box-content">
                                                                    <h5 class="animated bounceInRight m-0"><a href="#">Type</a></h5>
                                                                    <p>{{$leaves[$l]->leave_system->name ?? 'Leave'}} </p>
                                                                    <h5 class="animated bounceInRight m-0"><a href="#">Days</a></h5>
                                                                    <p>{{$totalDays}} </p>
                                                                    <label>Note</label>
                                                                    <textarea class="form-control">{{@$leaves[$l]->notes}}</textarea>
                                                                    <div class="posted">
                                                                        <div class="date posted-wrap mb-3"><b>Posted By</b> </div>
                                                                        <div class="main-outer" style="align-items: center; display: flex; flex-wrap: nowrap; justify-content: space-between;">
                                                                            <div>
                                                                                @if(file_exists($leaves[$l]->teacher->image))
                                                                                <img class="teacher_img" style="height:50px;width:50px; object-fit: cover; border-radius: 100%; margin-right:10px" src="{{asset($leaves[$l]->teacher->image)}}" />
                                                                                @endif
                                                                                {{$leaves[$l]->teacher->name}}
                                                                            </div>
                                                                            <div class="app-btn" style="gap: 10px; display: flex; ">
                                                                                @if($leaves[$l]->status == 0)
                                                                                <button type="button" onclick="leave_status('1' , '{{$leaves[$l]->id}}', '{{$leaves[$l]->user_id}}')" style="font-size: 16px !important; font-weight: 700 !important; color: #fff; border: none; margin: 0px !important; padding: 8px 12px !important; min-width: 100px !important; background-color: #51acad !important; border-radius: 8px !important;">Accept</button>
                                                                                <button style="font-size: 16px !important; font-weight: 700 !important; color: #fff; border: none; margin: 0px !important; padding: 8px 12px !important; min-width: 100px !important; background:#ff5167!important; border-radius: 8px !important;" type="button" onclick="leave_status('2' , '{{$leaves[$l]->id}}', '{{$leaves[$l]->user_id}}')" class="btn btn-danger btn-sm">Delete</button>
                                                                                @elseif($leaves[$l]->status == 1)
                                                                                <button style="font-size: 16px !important; font-weight: 700 !important; color: #fff; border: none; margin: 0px !important; padding: 8px 12px !important; min-width: 100px !important; background: gray !important; border-radius: 8px !important;"> Accepted </button>
                                                                                <button style="font-size: 16px !important; font-weight: 700 !important; color: #fff; border: none; margin: 0px !important; padding: 8px 12px !important; min-width: 100px !important; background:#ff5167!important; border-radius: 8px !important;" onclick="leave_status('3' , '{{$leaves[$l]->id}}', '{{$leaves[$l]->user_id}}')">Delete</button>
                                                                                @else
                                                                                <button style="font-size: 16px !important; font-weight: 700 !important; color: #fff; border: none; margin: 0px !important; padding: 8px 12px !important; min-width: 100px !important; background:grey !important; border-radius: 8px !important;"> Rejected </button>
                                                                                <button style="font-size: 16px !important; font-weight: 700 !important; color: #fff; border: none; margin: 0px !important; padding: 8px 12px !important; min-width: 100px !important; background: #ff5167 !important; border-radius: 8px !important;" onclick="leave_status('3' , '{{$leaves[$l]->id}}', '{{$leaves[$l]->user_id}}')">Delete</button>
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <!-- .Sidebar-content ends here -->
                                                        </div>
                                                        <!-- .Content ends here -->
                                                        </li>
                                                        <!-- .Li ends here -->
                                                    @endfor
                                                    @endif
                                                    </ul>
                                                    <!-- .Ul ends here -->
                                                    <div class="col-md-12">
                                                        <div class="journal-load-more">
                                                            <a href="#" id="loadMore" style="font-size:16px!important; font-weight:700!important; border-radius:8px!important;">See More</a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div id="leaves-calendar-view" class="leaves-view" style="display: none;">
                                <section class="calender__contact-section container-fluid" style="width: 100%!important; border-radius: 0px!important; background-color: #F7F9FD;">
                                    <div id="leaves-calendar" class="bg-white"></div>
                                </section>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="conatct_modal">
        <div class="modal" id="add_contact_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <div class="modal-title">
                            <div class="children_img"></div>
                            <div class="children_name"></div>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="message"></div>
                        <form id="add_contact_form" action="javascript:void(0)" method="post">
                            @csrf
                            <input type="hidden" id="student_id" name="student_id" />
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" class="form-control" required name="name" id="">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="text" class="form-control" required name="email" id="">
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone(mobile)</label>
                                <input type="text" class="form-control" required name="phone" id="">
                            </div>
                            <div class="form-group">
                                <label for="email">Phone(home)</label>
                                <input type="text" class="form-control" required name="home" id="">
                            </div>
                            <div class="form-group">
                                <label for="email">Phone(work)</label>
                                <input type="text" class="form-control" required name="work" id="">
                            </div>
                            <div class="d-flex">
                                <button type="submit" class=" w-50 btn btn-success">Add Contact</button>
                                <button type="button" class=" w-50 btn btn-secondary"
                                    data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal" id="parent_guradian_form_modal" tabindex="-1" role="dialog"
            aria-labelledby="myModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <div class="modal-header">
                        <div class="modal-title">
                            <div class="children_img"></div>
                            <div class="children_name"></div>
                        </div>
                        <button type="button" class="close" data-bs-dismiss="modal">&times;</button>
                    </div>
                    <!-- Modal body -->
                    <div class="modal-body">
                        <div class="messages"></div>
                        <div id="parent_guradian_form"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade" id="leaveModalclass" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                    <!-- For example, you can display the response -->

                    <p id="modal-contentss1"></p>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalcheckinout" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                    <!-- For example, you can display the response -->
                    <section class="apply-wrap five container-fluid">
                        <h2 class="text-center mb-2" id="modal_title_txt"></h2>
                        <h5 class="text-center mb-2">Date : {{ date('l M, d') }}</h5>
                        <div class="container">
                            @if ($message = Session::get('success'))
                            <div class="alert alert-success alert-block">
                                <button type="button" class="close" data-dismiss="alert">×</button>
                                <strong>{{ $message }}</strong>
                            </div>
                            @endif
                            <form action="{{url('staff/attendance/store')}}" method="POST" id="attendanceEntry_form">
                                @csrf
                                <!-- Time Selection -->
                                <div class="form-group row">
                                    <div class="col-sm-12">
                                        <label>Time:</label>
                                        <div class="row">
                                            <input type="hidden" id="entry_for" name="entry_for" value="">
                                            <input type="hidden" id="teacher_id" name="teacher_id" value="">
                                            <div class="col-md-6">
                                                <select id="time_hr" name="hours" class="time optional input-time form-control mb-3" required>
                                                    <option value="00">12 AM</option>
                                                    <option value="01">01 AM</option>
                                                    <option value="02">02 AM</option>
                                                    <option value="03">03 AM</option>
                                                    <option value="04">04 AM</option>
                                                    <option value="05">05 AM</option>
                                                    <option value="06">06 AM</option>
                                                    <option value="07">07 AM</option>
                                                    <option value="08">08 AM</option>
                                                    <option value="09">09 AM</option>
                                                    <option value="10">10 AM</option>
                                                    <option value="11">11 AM</option>
                                                    <option value="12">12 PM</option>
                                                    <option value="13">01 PM</option>
                                                    <option value="14">02 PM</option>
                                                    <option value="15">03 PM</option>
                                                    <option value="16">04 PM</option>
                                                    <option value="17">05 PM</option>
                                                    <option value="18">06 PM</option>
                                                    <option value="19">07 PM</option>
                                                    <option value="20">08 PM</option>
                                                    <option value="21">09 PM</option>
                                                    <option value="22">10 PM</option>
                                                    <option value="23">11 PM</option>
                                                    <option value="24">12 AM</option>
                                                </select>
                                            </div>
                                            <div class="col-md-6">

                                                <select id="time_min" name="minutes" class="time optional input-time form-control mb-3" required>
                                                    <option value="00"> 00 </option>
                                                    <option value="01"> 01 </option>
                                                    <option value="02"> 02 </option>
                                                    <option value="03"> 03 </option>
                                                    <option value="04"> 04 </option>
                                                    <option value="05"> 05 </option>
                                                    <option value="06"> 06 </option>
                                                    <option value="07"> 07 </option>
                                                    <option value="08"> 08 </option>
                                                    <option value="09"> 09 </option>
                                                    <option value="10"> 10 </option>
                                                    <option value="11"> 11 </option>
                                                    <option value="12"> 12 </option>
                                                    <option value="13"> 13 </option>
                                                    <option value="14"> 14 </option>
                                                    <option value="15"> 15 </option>
                                                    <option value="16"> 16 </option>
                                                    <option value="17"> 17 </option>
                                                    <option value="18"> 18 </option>
                                                    <option value="19"> 19 </option>
                                                    <option value="20"> 20 </option>
                                                    <option value="21"> 21 </option>
                                                    <option value="22"> 22 </option>
                                                    <option value="23"> 23 </option>
                                                    <option value="24"> 24 </option>
                                                    <option value="25"> 25 </option>
                                                    <option value="26"> 26 </option>
                                                    <option value="27"> 27 </option>
                                                    <option value="28"> 28 </option>
                                                    <option value="29"> 29 </option>
                                                    <option value="30"> 30 </option>
                                                    <option value="31"> 31 </option>
                                                    <option value="32"> 32 </option>
                                                    <option value="33"> 33 </option>
                                                    <option value="34"> 34 </option>
                                                    <option value="35"> 35 </option>
                                                    <option value="36"> 36 </option>
                                                    <option value="37"> 37 </option>
                                                    <option value="38"> 38 </option>
                                                    <option value="39"> 39 </option>
                                                    <option value="40"> 40 </option>
                                                    <option value="41"> 41 </option>
                                                    <option value="42"> 42 </option>
                                                    <option value="43"> 43 </option>
                                                    <option value="44"> 44 </option>
                                                    <option value="45"> 45 </option>
                                                    <option value="46"> 46 </option>
                                                    <option value="47"> 47 </option>
                                                    <option value="48"> 48 </option>
                                                    <option value="49"> 49 </option>
                                                    <option value="50"> 50 </option>
                                                    <option value="51"> 51 </option>
                                                    <option value="52"> 52 </option>
                                                    <option value="53"> 53 </option>
                                                    <option value="54"> 54 </option>
                                                    <option value="55"> 55 </option>
                                                    <option value="56"> 56 </option>
                                                    <option value="57"> 57 </option>
                                                    <option value="58"> 58 </option>
                                                    <option value="59"> 59 </option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" value="Add Entries" style="background-color: #51acad; border-color:#51acad; font-weight:700;">
                                </div>

                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModalSetPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header"></div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                    <!-- For example, you can display the response -->
                    <section class="apply-wrap five container-fluid">
                        <h2 class="text-center mb-2" id="">Set Password</h2>
                        
                        <div class="container">
                            
                            <form action="" method="POST" id="setTeacherPassword_form" onsubmit="setTeacherPassword(); return false;">
                                @csrf
                                <input type="hidden" id="set_pass_teacher_id" name="teacher_id" value="">
                                
                                <div class="row">
                                    <div class="col-md-6">
                                        <label>Password:</label>
                                        <input type="text" id="password" name="password" class="form-control mb-3" style="max-width:100% !important;" required>
                                    </div>
                                    <div class="col-md-6">
                                        <label>Confirm Password:</label>
                                        <input type="text" id="password_confirmation" name="password_confirmation" class="form-control mb-3" style="max-width:100% !important;" required>
                                    </div>
                                </div>

                                
                                <!-- Submit Button -->
                                <div class="text-center">
                                    <input type="submit" class="btn btn-primary" value="Change" style="background-color: #51acad; border-color:#51acad; font-weight:700;">
                                </div>

                            </form>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                </div>
                <div class="modal-body">
                    <!-- Your modal content goes here -->
                    <!-- For example, you can display the response -->
                    <section class="apply-wrap five container-fluid">
                        <div class="container">
                            <div class="apply-to-form">
                                <div class="tempbox-row row" id="attachments_div">
                                    <label for="inputEmail3" class=" col-sm-3 col-form-label">Attachment</label>
                                    <div class="col-sm-7">
                                        <img id="attachments" src="" style="max-width: 100%; height: auto;">
                                        <a href="" download="" id="download"><i class="fas fa-download"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('styles')
    <style>
        /*----------------Contact-wrap------------------------*/
        .contact-wrap a.orange-btn.btn {
            margin-top: 0;
        }


        div#buttonContainer {
            position: absolute;
            right: 20px;
            top: 20px;
        }

        .add_child_staff {
            position: relative;
        }

        div#buttonContainer a {
            font-size: 15px !important;
            margin-bottom: 0px !important;
            border: none !important;
            font-family: 'Nunito', sans-serif !important;
            font-weight: 700;
        }

        /* Mobile Responsive Styles */
        @media(max-width: 767px) {
            .outer-dashbox {
                margin-bottom: 20px;
            }

            .outer-dashbox .col-md-3 {
                margin-bottom: 15px;
            }

            .dashboard-box {
                padding: 10px !important;
            }

            .dashboard-icon img {
                width: 30px !important;
            }

            .dashboard-teext p {
                font-size: 14px !important;
            }

            .dashboard-teext p.bold {
                font-size: 16px !important;
            }

            .nav-pills {
                padding: 10px !important;
                gap: 20px !important;
            }

            .nav-pills .nav-link {
                padding: 8px 12px !important;
                font-size: 14px !important;
            }
            
        }


        /* table tr td:first-child span.img-span{
              position: relative;
            height: 50px;
            display: inline-block;
            width: 50px;
           } */
        /* table tr td:first-child span.date-span{
              background-color: #51acad;
            display: table-cell;
            vertical-align: middle;
            height: 55px;
            text-align: center;
            font-size: 9px;
            width: 55px;
            border-radius: 100%;
            padding: 10px;
            color: #fff;
           } */
        .contact-wrap #DataTables_Table_0_wrapper tbody td:nth-child(4) {
            width: 90px !important;
            text-align: left !important;
        }

        .btnactive {
            font-size: 14px !important;
            font-weight: 400 !important;
        }

        .table-striped td:first-child a {
            font-weight: bold;
        }

        .table-striped img {
            margin-right: 12px !important;
        }

        .table-striped td:first-child a {
            color: #212525 !important;
            text-transform: capitalize;
            font-weight: bold !important;
        }

        .contact-wrap #DataTables_Table_0_wrapper tbody td {}

        #pills-home .choose-action {
            /* margin-bottom: 20px; */
            z-index: 1;
            margin-left: auto;
            position: relative;
            /* text-align: center; */
            bottom: -60px;
            gap: 10px;
            display: flex;
            padding-right: 0;
            margin-right: 215px;
        }

        /* Filter controls for teachers contact tab */
        .contact-wrap #pills-home .choose-action {
            z-index: 1;
            margin-left: auto;
            position: relative;
            bottom: 0;
            gap: 10px;
            display: flex;
            padding-right: 0;
            margin-right: 10px;
        }

        /* Style for the filter container */
        .contact-wrap #pills-home .table-contain {
            background: #fff;
            border-radius: 10px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 1px 2px 10px #cccccc96;
        }

        /* Style for the filter selects */
        .contact-wrap #pills-home .choose-action select {
            min-width: 145px;
            font-size: 16px;
            height: 40px;
            color: #212529;
            border: 1px solid #e7e7e7 !important;
            border-radius: 5px;
            padding: 8px 12px;
        }

        /* Style for the search box */
        .contact-wrap #pills-home .search-box {
            display: flex;
            align-items: center;
        }

        .contact-wrap #pills-home .search-box input {
            min-width: 200px;
            font-size: 16px;
            height: 40px;
            color: #212529;
            border: 1px solid #e7e7e7 !important;
            border-radius: 5px;
            padding: 8px 12px;
        }

        /* Hide default DataTable search box */
        .data-tablestaff_filter {
            display: none !important;
        }

        .total-album-box {
            position: relative;
        }

        .total-album-box:after {
            content: '\f073';
            top: 7px;
            right: 13px;
            position: absolute;
            font-family: "Font Awesome 5 Free" !important;
            color: #212525;
            font-size: 20px;
        }

        .total-album-box select {
            appearance: none;
        }

        #pills-home .choose-action select {
            min-width: 145px;
            font-size: 16px;
            height: 40px;
            color: #212529;
            border: 1px solid #e7e7e7 !important;
            display: block;
        }

        .contact-wrap #DataTables_Table_0_wrapper tbody td:nth-child(4) input {
            margin-left: 25px;
            width: 20px;
            height: 20px;
        }

        .col-md-12.cont h2 {
            margin: 0;
            font-family: 'Nunito', sans-serif !important;
            font-weight: 700;
            font-size: 20px;
            position: relative;
            top: 33px;
            display: inline;
            left: 25px;
        }

        div#DataTables_Table_0_filter input {
            height: 40px;
            border: 1px solid #e7e7e7 !important;
            border-radius: 4px;
        }

        table#DataTables_Table_0,
        table.dataTable.no-footer {
            border-top: 1px solid #dddddd;
            padding-top: 0px;
            margin-top: 15px !important;
        }

        div#DataTables_Table_0_filter {
            margin-right: 20px;
        }

        .table-contain {
            box-shadow: 1px 2px 10px #cccccc96;
            border-radius: 10px;
        }

        table.dataTable thead th {
            font-family: 'Nunito', sans-serif !important;
            padding: 20px;
            font-weight: 700;
            font-size: 14px;
        }

        .contact-wrap #DataTables_Table_0_wrapper tbody td {
            font-family: 'Nunito', sans-serif !important;
            width: auto !important;
        }

        #DataTables_Table_0 tr {
            display: table-row !important;
        }

        .table_contacts-section table.table.table-striped tr {
            grid-template-columns: repeat(4, 25%) !important;
        }

        .kids_search_main {
            display: flex;
            align-items: center;
        }

        .kids_search_main_class_name {
            width: 40%;
        }

        table.dataTable.no-footer {
            border-bottom: 1px solid #dddddd !important;
        }

        a.btn.btn-gray {
            background: #EC7348;
            margin-bottom: 0px !important;
        }

        .pagination .paginate_button:nth-child(3) a:after,
        .pagination .paginate_button:first-child a:before {
            display: none !important;
        }

        .pagination .page-item.active .page-link {
            color: #fff;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.5em !important;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            border: none !important;
        }

        th.profile-person img {
            width: 80px !important;
            height: 80px !important;
            object-fit: cover !important;
            border-radius: 100% !important;
            margin-right: 50px !important;
        }

        th.profile-person {
            display: flex;
            align-items: center;
        }

        th.profile-person p {
            font-weight: 400;
        }

        .contact-wrap table.table.table-striped tr {
            display: table-row !important;
            padding-left: 0px !important;
        }

        .contact-wrap table.table.table-striped th,
        .contact-wrap table.table.table-striped td {
            display: table-cell !important;
            width: auto !important;
        }

        .contact-wrap table.table.table-striped th:first-child,
        .contact-wrap table.table.table-striped td:first-child {
            padding-left: 25px;
            width: 224px !important;
            Font-weight: bold;
        }

        .contact-wrap table.table.table-striped td:first-child {
            font-weight: 700 !important;
            font-family: 'Nunito', sans-serif !important;
        }

        .contact-wrap tbody td {
            width: 33% !important;
        }

        .staff-wrap th {
            width: 20%;
        }

        .staff-wrap td {
            width: 20%;
        }

        button.btn-primary,
        a.btn-gray {
            font-size: 16px !important;
            font-weight: 700 !important;
            padding: 8px 16px !important;
            border-radius: 8px !important;
        }

        .error {
            color: red;
        }

        #parent_guradian_form_modal .modal-dialog {
            max-width: 800px;
        }

        div#parent_guradian_form {
            display: flex;
            justify-content: space-evenly;
            grid-gap: 80px;
        }

        #parent_guradian_form_modal .modal-title {
            display: grid;
            width: 100%;
            justify-content: center;
            grid-gap: 20px;
        }

        .form-group input {
            max-width: 170px !important;
        }

        .form-group {
            display: flex;
            grid-gap: 50px;
            justify-content: flex-end;
        }

        .main__header__-contact {
            margin: 0 !important;
        }

        /* .contact-wrap div#DataTables_Table_0_filter {
           margin-top: -75px;
           } */
        /*.contact-wrap .sub__header-cont-sect {
           margin-top: 20px;
           }
           */

        .contact-wrap table.table.table-striped td:first-child {
            display: flex !important;
            gap: 15px;
            color: #000000 !important;
            align-items: center;
            height: 70px;
            text-transform: capitalize !important;
        }

        .contact-tabs li button,
        .contact-tabs .li button.activ {
            color: #878787;
        }

        #DataTables_Table_1_info {
            padding-left: 25px;
        }

        .contact-tabs li button.active,
        .contact-tabs li button:hover {
            color: #EC7348 !important;
            border-bottom: 4px solid #EC7348 !important;
        }

        .contact-tabs li button:focus-visible {
            outline: 0;
        }

        .contact-tabs ul.nav-pills {
            border: none;
            border-radius: 5px;
            padding: 16px 10px 16px 30px;
            margin-bottom: 25px !important;
            gap: 50px;
            background-color: #fff;
        }

        .contact-tabs li button {
            background: transparent !important;
            font-size: 16px;
            border: none;
            padding-bottom: 16px !important;
            padding: 0px;
            font-weight: 600;
            font-family: 'Nunito', sans-serif !important;

        }

        .table_contacts-section table thead th:first-child,
        .table_contacts-section table tbody td:first-child {
            text-align: left;
            padding-left: 25px;
        }

        .table_contacts-section table tbody td {
            text-align: center;
        }

        #pills-profile .dataTables_filter input {
            height: 40px;
            margin-right: 25px !important;
            border: 1px solid #e7e7e7 !important;
            border-radius: 4px;
        }

        table tr {
            padding-left: 0px !important;
        }

        button#dropdownMenuButton {
            font-size: 16px !important;
            margin-bottom: 0px !important;
            border: none !important;
            font-family: 'Nunito', sans-serif !important;
        }

        table tr td:first-child span.badge {
            color: #51AD7B !important;
        }


        @media(max-width:767px) {
            td[data-th="Assigned Class"] {
                flex-wrap: wrap !important;
            }

            div#DataTables_Table_1_filter {
                margin-top: 20px !important;
            }

            #DataTables_Table_1_wrapper .col-sm-12.col-md-6:last-child {
                padding: 0 35px !important;
            }

            #DataTables_Table_1_wrapper .col-sm-12.col-md-6:last-child #DataTables_Table_1_filter label {
                width: 100% !important;
            }

            #DataTables_Table_1_wrapper .col-sm-12.col-md-6:last-child #DataTables_Table_1_filter label input {
                width: 100%;
                display: block;
                margin: 0px !important;
            }

            div#buttonContainer a {
                min-width: 100% !important;
            }

            div#buttonContainer {
                right: 20px;
                top: 130px;
                left: 20px;
                justify-content: flex-start !important;
            }

            .contact-tabs ul.nav-pills {
                padding-bottom: 80px !important;
            }

            .contact-wrap #DataTables_Table_0_wrapper tbody td:nth-child(4) {
                width: 89% !important;
            }

            div.dataTables_wrapper div.dataTables_paginate ul.pagination {
                flex-wrap: wrap !important;
            }

            #pills-home .choose-action select:first-child {
                margin-right: 0px !important;
            }

            /* Mobile responsive for teachers filter controls */
            .contact-wrap #pills-home .choose-action {
                margin-left: 0px !important;
                margin: 0px;
                position: relative;
                top: 0;
                margin-bottom: 20px !important;
                width: 100% !important;
                max-width: 100% !important;
            }

            .contact-wrap #pills-home .choose-action select,
            .contact-wrap #pills-home .choose-action {
                margin-right: 0px;
                width: 100% !important;
                max-width: 100% !important;
            }

            /* Mobile responsive for search box */
            .contact-wrap #pills-home .choose-action {
                flex-direction: column;
                gap: 10px;
            }

            .contact-wrap #pills-home .search-box input {
                min-width: 100% !important;
                width: 100% !important;
            }

            .contact-wrap #DataTables_Table_0_wrapper tbody td:nth-child(3),
            #DataTables_Table_1 td:nth-child(3) {
                word-break: break-all;
                text-align: left !important;
            }

            /* #pills-home .choose-action{
              width: 100%!important;
              min-width:100%!important;
              max-width: 100%!important;
           } */
            #pills-home .choose-action select,
            #pills-home .choose-action {
                margin-right: 40px;
                width: 100% !important;
                max-width: 100% !important;
            }

            div#DataTables_Table_0_filter {
                margin: 10px 25px !important;
            }

            #DataTables_Table_0_filter label {
                width: 100% !important;
            }

            div#DataTables_Table_0_filter input {
                margin: 0;
                width: 100%;
            }

            .choose-action {
                margin-left: 40px !important;
                margin: 0px;
                position: relative;
                top: 55px;
                margin-bottom: 65px !important;
            }

            .col-md-12.cont h2 {
                margin-bottom: 40px;
            }

            div#DataTables_Table_0_filter,
            div#DataTables_Table_1_filter {
                text-align: right;
                padding: 0px;
            }

            #DataTables_Table_0_filter label,
            #DataTables_Table_1_filter label {
                font-size: 0px;
            }

            #pills-home .choose-action {
                margin: 0px;
            }

            .dataTables_wrapper.dt-bootstrap4 table.table.table-striped tr {
                display: block !important;
            }

            .col-md-12.cont h2 {
                top: 40px;
            }

            .contact-wrap table.table.table-striped th,
            .contact-wrap table.table.table-striped td {
                display: flex !important;
                /* width: 100%!important; */
            }

            #pills-home .choose-action {
                margin-left: auto;
                max-width: 200px;
                width: 100%;
            }

            .contact-wrap table.table.table-striped td:first-child {
                gap: 0px;
            }

            .contact-wrap table.table.table-striped td:first-child img {
                margin-right: 15px;
            }

            .contact-wrap #DataTables_Table_0_wrapper tbody td:nth-child(4) input {
                margin-left: 0px;
            }

            .table_contacts-section {
                overflow: hidden !important;
            }

            li.paginate_button.page-item.active {
                display: block !important;
                background-color: transparent !important;
            }
        }

        /* LEAVE TAB CSS */
        /* Calendar controls summary - matching index.blade.php */
        #leaves-calendar-controls .summary {
            display: grid;
            grid-template-columns: 66% 30%;
            gap: 3%;
            margin: 0;
            align-items: center;
            justify-items: end;
        }

        #leaves-calendar-controls .summary .stuyear::before {
            content: "\f073";
            position: relative;
            left: 0px;
            color: #878787;
            font-family: 'Font Awesome 5 Free';
            font-size: 20px;
            font-weight: 400;
        }

        /* Other summary contexts (for leave list items) */
        .summary {
            grid-template-columns: 100%;
            gap: 15px;
            margin-bottom: 20px;
        }

        .sidebar-content .box-content p {
            font-family: 'Nunito', sans-serif !important;
            margin-bottom: 20px;
            font-weight: 400;
            color: #212525;
        }

        .box-content textarea {
            font-size: 14px;
            font-family: 'Nunito', sans-serif !important;
            font-weight: 400;
            color: #212525;
        }

        .sidebar.widget a#loadMore {
            background-color: #51ACAD !important;
        }

        .summary-box {
            padding: 24px;
            border-radius: 0 0 10px 10px;
        }

        .dates-time {
            gap: 10px
        }

        .dates-time p {
            font-size: 16px !important;
            font-weight: 700;
            font-family: 'Nunito', sans-serif !important;
        }

        .box-content label {
            font-size: 16px;
            font-weight: 700;
            color: #212525;
            font-family: 'Nunito', sans-serif !important;
        }

        .event-top .events i {
            font-size: 16px;
            margin-right: 6px;
            font-weight: 600;
        }

        .event-top {
            background-color: #51ACAD;
            padding: 14px 20px;
            border-radius: 10px 10px 0 0;
        }

        .box-content {
            padding: 14px 20px 26px;
            background-color: #F3F9F9;
            border-radius: 0 0 10px 10px;
        }

        .Logs-wrap .content {
            margin-bottom: 24px;
        }

        .box-content .posted {
            margin-top: 16px;
        }

        .posted-wrap {
            display: block !important;
        }

        .posted-wrap b {
            font-size: 14px;
            color: #878787;
            font-family: 'Nunito', sans-serif !important;
            font-weight: 400;
        }

        .events p {
            font-size: 16px;
            font-weight: 600;
            margin: 0px;
            font-family: 'Nunito', sans-serif !important;
        }

        .sidebar-thumb {
            float: left;
            overflow: hidden;
        }

        .sidebar-thumb img {
            background: #fff;
            border: 1px dashed #e0e0e0;
            padding: 6px;
            height: 75px;
            width: 75px;
            -webkit-border-radius: 100px;
            -moz-border-radius: 100px;
            border-radius: 100px;
        }

        .sidebar-content h5 a:hover {
            color: #2996bd;
        }

        .sidebar-content h5 {
            margin: 10px 0px !important;
        }

        .sidebar-content h5 a {
            color: #212525;
            font-size: 16px;
            font-family: 'Nunito', sans-serif !important;
            cursor: pointer;
            font-weight: 700;
            line-height: 24px outline: 0 none;
            text-decoration: none;
        }

        .out_contents {
            display: none;
        }

        .journal-load-more {
            text-align: center;
            margin-top: 20px;
        }

        .journal-load-more a {
            display: inline-block;
            padding: 10px 20px;
            background-color: #51ACAD;
            color: white;
            text-decoration: none;
            border-radius: 8px;
        }

        @media(max-width:1340px) {
            .summary {
                grid-template-columns: 47% 50% !important;
                gap: 3%;
            }
        }

        @media(max-width:1300px) {
            .summary {
                grid-template-columns: 46% 51% !important;
                gap: 3%;
            }
        }

        @media only screen and (max-width: 767px) {
            .summary {
                gap: 1% !important;
            }

            .main-outer {
                flex-direction: column;
                align-items: flex-start !important;
                gap: 10px;
            }

            .journal-load-more {
                left: 27%;
            }

            .event-top {
                flex-direction: column;
                gap: 7px;
            }
        }

        ul, li {
            list-style: none;
        }

        .badge {
            color: #51AD7B !important;
        }

        /* teacher table css */

        .outer-dashbox .dashboard-box {
            display: flex;
            padding: 11px 16px;
            gap: 16px;
            box-shadow: 1px 3px 17px #dedcdc;
            border-radius: 7px;
            align-items: center;
            background-color: #fff;
        }

        .dashboard-box .dashboard-teext p:first-child {
            font-weight: 600 !important;
            font-family: 'Nunito', sans-serif !important;
            margin-bottom: 0px;
            color: #878787;
        }

        .dashboard-box .dashboard-teext p.bold {
            font-size: 20px !important;
            font-family: 'Nunito', sans-serif !important;
            color: #212525;
            font-weight: 700 !important;
        }


        .tab-pane table thead tr th:nth-child(1),
        .tab-pane table thead tr th {
            font-size: 14px !important;
            font-weight: 700;
            text-align: left !important;
            font-family: 'Nunito', sans-serif !important;
            color: #212525;
        }

        .active{
            background: transparent;
        }
            
        #teacher_section{
            background: #fff;
        }


        .child-status.not-present {
            margin: 0px;
            color: #FF4A6B;
            border-radius: 47px;
            padding: 3px 10px;
            background: #FFE5E9;
            display: inline-block;
        }

        .child-status.present {
            margin: 0px;
            color: #1FC17C;
            border-radius: 47px;
            padding: 3px 10px;
            background: #DEFFF1;
            display: inline-block;
        }

        .child-status.check-out {
            color: #FF8A00;
            margin: 0px;
            border-radius: 47px;
            padding: 3px 10px;
            background: #FFF4E7;
            display: inline-block;
        }

        .tab-pane table tr td:nth-child(2){
            text-align: center !important;
        }

        .tab-pane table tr td:last-child{
            text-align: center !important;
        }

        .tab-pane table thead tr th:nth-child(1), .tab-pane table thead tr th{
            text-align: center !important;
        }

        .tab-pane table thead tr th:nth-child(1), .tab-pane table thead tr th:nth-child(1){
            text-align: left !important;
        }


        .contact-wrap table.table.table-striped th{
            width: 42% !important;
        }

        .dropdown-menu{
            right: 0px !important;
            left: auto !important;
        }

        .inactive-badge {
            color: #dc3545 !important;
            display: inline-block;
            padding: 0.25em 0;
            font-size: 75%;
            font-weight: 700;
            line-height: 1;
            text-align: center;
            white-space: nowrap;
            vertical-align: baseline;
            border-radius: 0.25rem;
            transition: color 0.15s ease-in-out, background-color 0.15s ease-in-out, border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .contact-wrap table.table.table-striped th:first-child{
            width: 30% !important;
        }

        /* Tab buttons for leaves view */
        .tab-buttons button > i{
            margin-right: 10px;
        }
        .tab-buttons {
            display: flex;
            gap: 50px;
        }
        
        .tab-buttons button {
            background: transparent !important;
            color: #878787!important;
            font-size: 16px;
            border: none;
            padding-bottom: 16px !important;
            padding: 0px;
            font-weight: 600;
            font-family: 'Nunito', sans-serif !important;
            padding: 0 0 20px;
            cursor: pointer;
            border: none;
            outline: none;
            border-bottom: 2px solid transparent;
            background-color: transparent;
        }
        
        .tab-buttons button.active {
            background-color: #fff;
            color: #EC7348 !important;
            border-bottom: 4px solid #EC7348 !important;
        }

        .tab-buttons button:hover {
            color: #EC7348 !important;
            border-bottom: 4px solid #EC7348 !important;
        }

        .leaves-view {
            display: none;
        }

        .leaves-view.active {
            display: block;
        }

        #leaves-calendar {
            padding: 30px 48px 46px;
            border-radius: 5px;
        }

        /* Calendar section wrapper - matching index.blade.php */
        #leaves-calendar-view .calender__contact-section {
            width: 100%!important;
            border-radius: 0px!important;
            background-color: #F7F9FD;
        }

        /* Calendar cell borders - matching index.blade.php */
        #leaves-calendar .fc td{
            border:1px dashed #E0E0E0!important;
            border-bottom: none!important;
            border-top: none!important;
        }
        #leaves-calendar .fc-week .fc-bg{
            border-bottom:1px dashed #E0E0E0!important;
        }
        #leaves-calendar .fc-week:first-child .fc-bg{
            border-top:1px dashed #E0E0E0!important;
        }

        /* Calendar header styles */
        #leaves-calendar .fc-toolbar h2{
            font-size: 30px;
            font-family: 'Nunito', sans-serif!important;
            font-weight: 700;
            margin-bottom:54px;
            color: #333333!important;
        }
        #leaves-calendar table thead tr th{
            font-size: 14px;
            padding-bottom:10px!important;
            font-weight: 700;
            color: #333333;
            font-family: 'Inter', sans-serif!important;
        }
        #leaves-calendar table thead tr td{
            color: #A1A1A1!important;
            font-size: 14px!important;
            font-weight: 500;
        }

        /* Calendar event colors matching index.blade.php */
        #leaves-calendar .fc-content-skeleton table tbody tr:nth-of-type(odd) .fc-content{
            padding: 5px 6px!important;
            background-color: #FFF4E7!important;
            border-left: 2px solid #FF8A00;
            overflow: auto!important;
        }
        #leaves-calendar .fc-content-skeleton table tbody tr:nth-of-type(even) .fc-content{
            padding: 5px 6px!important;
            background-color: #E5F7FF!important;
            border-left: 2px solid #00B1FF;
            overflow: auto!important;
        }

        /* Calendar content text */
        #leaves-calendar .fc-content span.fc-title{
            font-size: 12px;
            font-family: 'Nunito', sans-serif!important;
            color: #212525;
            font-weight: 400;
        }

        /* Hide today button and agendaDay button */
        #leaves-calendar button.fc-today-button {
            display: none;
        }
        #leaves-calendar button.fc-agendaDay-button {
            display: none;
        }

        /* Calendar toolbar */
        #leaves-calendar .fc-toolbar .fc-left{
            display: none;
        }

        /* Calendar unthemed styles */
        #leaves-calendar .fc-unthemed .fc-popover, 
        #leaves-calendar .fc-unthemed .fc-row, 
        #leaves-calendar .fc-unthemed hr, 
        #leaves-calendar .fc-unthemed tbody, 
        #leaves-calendar .fc-unthemed td, 
        #leaves-calendar .fc-unthemed th, 
        #leaves-calendar .fc-unthemed thead {
            border-color: #ddd !important;
        }

        #leaves-calendar .fc-row.fc-widget-header {
            background: #fff;
        }

        #leaves-calendar .fc td.fc-widget-header{
            border: none!important;
        }

        #leaves-calendar tbody, #leaves-calendar .fc th{
            border: none!important;
        }

        /* Calendar table rows */
        #leaves-calendar table tbody tr:nth-of-type(odd){
            background-color: transparent!important;
        }

        @media(max-width:767px){
            #leaves-calendar {
                padding: 30px 20px 45px!important;
            }
            .tab-buttons {
                gap: 20px;
            }
            .tab-buttons button {
                font-size: 14px !important;
            }
        }

    </style>
@endsection
@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="text/javascript">
        function deleteTeacherRecord(ele, url) {

            if (confirm("Are you sure you want to delete this record") == false) {
                return false;
            }

            window.location.href = url


        }

        function deleteRecord(ele, userId) {
            if (confirm("Are you sure you want to delete this record") == false) {
                return false;
            }

            $.ajax({
                url: `{{ url('contacts/') }}/${userId}`,
                method: 'DELETE',
                data: {
                    "_token": `{{ csrf_token() }}`
                },
                success: function(res) {
                    if (res.status == 400) {
                        alert(
                            "Unable to delete the record as the student account contains information in the tuition plan."
                            );
                    } else {
                        $(ele).closest("tr").remove();
                        alert("Profile delete successfully");
                    }
                }
            })
        }


        $(document).ready(function() {

            $('#btn-dd').on('change', function() {

                var class_id = $(this).val();
                var checkeds = $('#checked_value').val();
                $.ajax({
                    url: "{{ route('shiftclass') }}",
                    method: 'get',
                    data: {
                        ids: checkeds,
                        class: class_id,
                    },

                    success: function(res) {
                        if (res.status == 400) {
                            //  $('.message').html(`<div class="alert alert-danger">${res.message}</div>`)
                            Swal.fire({
                                position: "center",
                                icon: "warning",
                                title: `${res.message}`,
                                showConfirmButton: false,
                                timer: 3500
                            });
                        }
                        if (res.status == 200) {
                            //  $('.message').html(`<div class="alert alert-success">${res.message}</div>`)
                            Swal.fire({
                                position: "center",
                                icon: "success",
                                title: `${res.message}`,
                                showConfirmButton: false,
                                timer: 3500,
                                willClose: () => {
                                    window.location.reload();
                                }
                            });
                        }
                    }
                })
            });







            $('.checkboxClickAll').on('change', function() {
                if ($(this).is(':checked')) {
                    $('.check_single').prop('checked', true);
                    $('#btn-dd').css('display', 'block');
                } else {
                    $('.check_single').prop('checked', false);
                    $('#btn-dd').css('display', 'none');

                }
            });
        });

        let studentTables;
        let table1;
        $(function() {
            studentTables = $('.data-table').DataTable({
                processing: true,
                serverSide: true,
                bLengthChange: false,
                ajax: {
                    url: "{{ url('contacts') }}",
                    data: function(d) {
                        d.class_id = $('#classroom_id').val(),
                            d.date = $("#contact_date").val(),
                            d.graduted = $("#graduted").val();
                        d.search = $('input[type="search"]').val();
                        d.type = $('#type').val();
                        d.absent_date = $('#absent_date').val();
                    }
                },
                order: [
                    [0, 'asc']
                ],
                columns: [

                    {
                        data: 'image',
                        name: 'image',
                        orderable: false,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Name');
                        }
                    },

                    {
                        data: 'con_2',
                        name: 'con_2',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Class');
                        }
                    },
                    // {data: 'address', name: 'address'},
                    {
                        data: 'con_1',
                        name: 'con_1',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Contact 1');
                        }
                    },
                    // {data: 'contact_2', name: 'contact_2', createdCell: function (td, cellData, rowData, row, col) {
                    //         $(td).attr('data-th', 'Contact 2');}},
                    {
                        data: 'checkbox',
                        name: 'checkbox',
                        orderable: false,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Select');
                        }
                    },

                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Action');
                        }
                    },
                ],
                initComplete: function() {
                    // Search input box me placeholder set kar rahe hain
                    var searchBox = $('.dataTables_filter input');
                    searchBox.attr('placeholder', 'Search');
                    $('.dataTables_filter label').contents().filter(function() {
                        return this.nodeType === 3; // Text node ko target karna
                    }).remove();
                }
            });

            $("#graduted").on('change', function() {
                studentTables.draw();
                table1.draw();
            });

            $('.data-table tbody').on('change', 'input.check_single', function() {
                if ($(this).is(':checked').length === $('.check_single').length) {
                    $('.checkboxClickAll').prop('checked', true);

                    $('#btn-dd').css('display', 'block');
                } else {
                    $('.checkboxClickAll').prop('checked', false);

                }



                var checkedIds = $('.check_single:checked').map(function() {
                    return $(this).data('id');
                }).get().join(',');
                console.log(checkedIds);
                $('#checked_value').val(checkedIds);


                if ($(this).is(':checked')) {
                    $('#btn-dd').css('display', 'block');
                } else {

                    if ($('.check_single:checked').length == 0) {
                        $('#btn-dd').css('display', 'none');
                    }

                }

            });
            table1 = $('.data-tablestaff').DataTable({
                processing: true,
                serverSide: true,
                bLengthChange: false,
                searching: false,
                ajax: {
                    url: "{{ url('getstaff') }}",
                    data: function(d) {
                        d.email = $('#email_search').val();
                        d.class_id = $('#btn-dd').val() || $('#classroom_id').val();
                        d.date = $('#contact_date').val();
                        d.staff_name = $('#teacher_search').val();
                        d.active = $("#graduted").val();
                    }
                },
                order: [
                    [0, 'asc']
                ],
                columns: [{
                        data: 'image',
                        name: 'image',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Name');
                        }
                    },
                    {
                        data: 'assignclass',
                        name: 'assignclass',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Assigned Class');
                        }
                    },
                    {
                        data: 'contact_number',
                        name: 'contact_number',
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Contact');
                        }
                    },
                    //  {data: 'schedule', name: 'schedule'},
                    //  {data: 'dob', name: 'dob'},
                    {
                        data: 'action',
                        name: 'action',
                        orderable: true,
                        searchable: true,
                        createdCell: function(td, cellData, rowData, row, col) {
                            $(td).attr('data-th', 'Action');
                        }
                    },
                ],
                order: []
            });
            $('#email_search').on('keyup', function() {
                table1.draw();
            });

            // Handle custom search input for teachers
            $('#teacher_search').on('keyup', function() {
                table1.draw();
            });

            // Handle class selection for teachers
            $('#btn-dd').on('change', function() {
                table1.draw();
            });



            $('.student_gender').click(function() {
                let class_id = $(this).attr('date-value');
                $('#classroom_id').val(class_id);
                table.draw();
            })



            $('.classroom').click(function() {
                let class_id = $(this).attr('date-value');
                $('#classroom_id').val(class_id);
                table.draw();
            })





        });

        $('#contact_date').change(function() {
            studentTables.draw();
            table1.draw();
        });

        function add_contact(id) {
            let image = $(`#contact_${id}`).data('img');
            let name = $(`#contact_${id}`).data('name');
            $('#student_id').val(id);
            $('.children_img').html(`<img src="${image}" style="height:80px;width:80px" />`);
            $('.children_name').html(`<h3>${name}</h3>`);

            $('#add_contact_modal').modal('show');



        }


        $(document).ready(function($) {

            $("#add_contact_form").validate({
                rules: {
                    name: "required",
                    email: {
                        required: true,
                        email: true
                    },
                },
                messages: {
                    name: "Please enter your Name",
                    email: {
                        required: "Please provide a password",
                        email: "Please enter valid email"
                    },

                },
                submitHandler: function(form) {


                    $.ajax({
                        url: "{{ route('contacts') }}",
                        method: 'post',
                        data: $(form).serialize(),

                        success: function(res) {
                            if (res.status == 400) {
                                //  $('.message').html(`<div class="alert alert-danger">${res.message}</div>`)
                                Swal.fire({
                                    position: "center",
                                    icon: "warning",
                                    title: `${res.message}`,
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                            if (res.status == 200) {
                                //  $('.message').html(`<div class="alert alert-success">${res.message}</div>`)
                                Swal.fire({
                                    position: "center",
                                    icon: "success",
                                    title: `${res.message}`,
                                    showConfirmButton: false,
                                    timer: 3500
                                });
                            }
                        }
                    })
                }

            });
        });


        function editShowContact(id) {
            let student = $(`#contacts_${id}`).data('name');
            let image = $(`#contacts_${id}`).data('img');


            $('.children_img').html(`<img src='${image}' style="height:100px;width:100px;" />`);
            $('.children_name').html(`<h3>${student}</h3>`);

            $.ajax({
                url: "{{ url('editShowContact?id=') }}" + id,
                method: 'get',
                success: function(res) {
                    $('#parent_guradian_form').html(" ");
                    $.each(res.data, function(key, data) {
                        $('#parent_guradian_form').append('<form id="form_' + data.id +
                            '" onsubmit="updateContact(event , ' + data.id + '); return false;" action="javascript:void(0)" method="post">\
                <input type="hidden"  name="parent_id" value=' + data.id + ' />\
                <input type="hidden"  name="contact_id" value=' + data.parent_contact.id + ' />\
              <div class="form-group">\
                <label for="name">Name</label>\
                <input type="text" class="form-control" required name="name" value=' + data.name + '>\
              </div>\
              <div class="form-group">\
                <label for="email">Email</label>\
                <input type="text" class="form-control" required name="email" value=' + data.email + '>\
              </div>\
              <div class="form-group">\
                <label for="phone">Phone(mobile)</label>\
                <input type="text" class="form-control" name="phone" value=' + data.contact_number + ' required name="c" id="">\
              </div>\
              <div class="form-group">\
                <label for="email">Phone(home)</label>\
                <input type="text" class="form-control" required name="home" value=' + data.parent_contact.home + '>\
              </div>\
              <div class="form-group">\
                <label for="email">Phone(work)</label>\
                <input type="text" class="form-control" required name="work"value=' + data.parent_contact.work + '>\
              </div>\
              <div class="d-flex">\
              <button type="submit" class=" btn btn-success" >Edit Contact</button>\
              </div>\
              </form>')

                    });

                    $('#parent_guradian_form_modal').modal('show');
                }
            })
        }

        function updateContact(data, id) {

            $.ajax({
                url: "{{ url('editShowContact') }}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $(`#form_${id}`).serialize(),
                success: function(res) {
                    if (res.status == 400) {
                        // $('.messages').html(`<div class="alert alert-danger">${res.message}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>`)
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    if (res.status == 200) {
                        // $('.messages').html(`<div class="alert alert-success">${res.message}<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button></div>`)
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }

            })
        }

        function hide(id) {
            var close = document.getElementById(id);
            close.style.display = "none";
            console.log(close.style.display);
            setTimeout(() => {
                console.log(close.style.display);
            });
        }

        function graduted(class_id) {
            window.location.href = `{{ url('accounts/${class_id}/graduated') }}`
        }

      //   $(document).ready(function() {
      //       // Initially toggle the buttons based on the active tab

      //       $('.childbtn').show(); // Show Add Child button
      //       $('.staffbtn').hide(); // Hide Add Staff button

      //       $('#pills-home-tab').click(function() {
      //           $('.childbtn').show(); // Show Add Child button
      //           $('.staffbtn').hide(); // Hide Add Staff button
      //       });

      //       $('#pills-profile-tab').click(function() {
      //           $('.staffbtn').show(); // Show Add Staff button
      //           $('.childbtn').hide(); // Hide Add Child button
      //       });
      //   });
        $(document).on('click', '.dropdown-menu .leaveapply', function(e) {
            e.preventDefault();
            // $('.leaveapply').click(function() {
            console.log('safdass');
            var techerid = $(this).data('id');
            $.ajax({
                url: `{{ url('teacher/showleaveform') }}`,
                method: 'POST',
                data: {
                    techerid: techerid,
                    "_token": $('meta[name="csrf-token"]').attr('content')
                },
                success: function(res) {
                    HoldOn.close();
                    $('#leaveModalclass').modal('show');
                    $('#modal-contentss1').html(res);
                },
                error(err) {
                    $("#save_btn").attr("disabled", false).text("Save");

                }
            })


        });


        function addStudentForm(e) {

            HoldOn.open({
                theme: "sk-dot",
                message: 'Please wait...',

            });
            $("#save_btn").attr("disabled", true).text("Loading..");
            let formData = new FormData(e);
            formData.append("_token", $('meta[name="csrf-token"]').attr('content'));
            $.ajax({
                url: `{{ url('teacher/addleavebyadmin') }}`,
                method: 'POST',
                data: formData,
                contentType: false,
                processData: false,
                success: function(res) {
                    HoldOn.close();
                    $("#save_btn").attr("disabled", false).text("Save");
                    if (res.status == 400) {
                        var n = Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 3500
                        });
                        return false;
                    }

                    if (res.status == 200) {


                        //   if(res?.url){
                        //      window.location.href = res?.url;
                        //   }

                        var n = Swal.fire({
                            position: "center",
                            icon: "success",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    setTimeout(() => {
                        n.close();
                        window.location.reload();
                    }, 5000);
                },
                error(err) {
                    $("#save_btn").attr("disabled", false).text("Save");

                }
            })
        }

        $(document).ready(function() {
            // Check if email is present in the query string
            const urlParams = new URLSearchParams(window.location.search);
            const email = urlParams.get('email');
            if (email) {
                // Set the search box value and trigger the search
                $('.dataTables_filter input').val(email);
                $('.dataTables_filter input').trigger('keyup');
            }
        });

        $(document).ready(function() {
            // Initially hide leaves tab content and search
            $('#eval').hide();
            $('.leavestab').hide();
            
            // Handle tab switching for all tabs
            $('.nav-link').on('click', function(e) {
                e.preventDefault();
                var target = $(this).data('bs-target');
                
                // Remove active class from all tabs
                $('.nav-link').removeClass('active');
                // Add active class to clicked tab
                $(this).addClass('active');
                
                // Hide all tab panes
                $('.tab-pane').removeClass('show active');
                
                // Show the selected tab pane
                $(target).addClass('show active');
                
                // Handle specific tab content visibility
                if (target === '#pills-home') {
                    // Contact tab
                    $("#pills-profile").addClass('show active');
                    $('#eval').hide();
                    $('#attendance-tab').hide();
                    $('.leavestab').hide();
                    $('#pills-home').show();
                } else if (target === '#attendance-tab') {
                    // Attendance tab
                    $("#attendance-tab").addClass('show active');
                    $('#eval').hide();
                    $('#pills-home').hide();
                    $('.leavestab').hide();
                    $('#attendance-tab').show();
                } else if (target === '#eval') {
                    // Leaves tab
                    $("#eval").addClass('show active');
                    $('#pills-home').hide();
                    $('#attendance-tab').hide();
                    $('.leavestab').show();
                    $('#eval').show();
                }
            });

            // Show initial leaves content
            $(".out_contents").slice(0, 5).show();
            $("#loadMore").on("click", function(e) {
                e.preventDefault();
                $(".out_contents:hidden").slice(0, 5).slideDown();
                if ($(".out_contents:hidden").length == 0) {
                    $("#loadMore").css('display', 'none');
                }
            });
        });

        $(document).on('click', '.setpassword', function() {
            
            var techerid = $(this).data('id');
            $("#set_pass_teacher_id").val(techerid);
            $("#password, #password_confirmation").val('');
            $('#myModalSetPassword').modal('show');
        });

        function setTeacherPassword() {
            
            if (confirm("Are you sure you want to change teacher password...") == false) {
                return false;
            }

            $.ajax({
                url: "{{ url('staff/teachers/updatepassword') }}",
                method: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: $("#setTeacherPassword_form").serialize(),
                success: function(res) {
                    if (res.status == 400) {
                        Swal.fire({
                            position: "center",
                            icon: "warning",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                    if (res.status == 200) {
                        $("#password, #password_confirmation, #set_pass_teacher_id").val('');
                        $('#myModalSetPassword').modal('hide');
                        Swal.fire({
                            position: "center",
                            icon: "success",
                            title: `${res.message}`,
                            showConfirmButton: false,
                            timer: 3500
                        });
                    }
                }
            })
        }
        
        function myfunctionAttendance(userId, flag, checktime) {

            if(flag == '1'){
                $("#modal_title_txt").text('Entry : Check-In');
            }else{
                $("#modal_title_txt").text('Entry : Check-out');
            }

            if(checktime != ''){
                var [hour, minute] = checktime.split(':');
            }else{
                var hour = '00';
                var minute = '00';
            }

            $("#teacher_id").val(userId);
            $("#entry_for").val(flag);
            $("#time_hr").val(hour);
            $("#time_min").val(minute);

            $('#myModalcheckinout').modal('show');
        }
        function leave_status(status, leave_id, teacher_id) {
            if (status == 1) {
                var warning = 'Are you sure you want to Accept ?';
                if (confirm(warning)) {
                    window.location.href = `{{url('teacher/${teacher_id}/leave/${leave_id}/edit/${status}')}}`;
                } else {
                    return false;
                }
            } else {
                if (status == 3) {
                    var warning = 'Are you sure you want to delete ?';
                } else {
                    var warning = 'Are you sure you want to Reject ?';
                }
                if (confirm(warning)) {
                    window.location.href = `{{url('teacher/${teacher_id}/leave/${leave_id}/edit/${status}')}}`;
                } else {
                    return false;
                }
            }
        }

        function myfunction(notes, imageUrl, isImage, file) {
            $('#exampleFormControlTextarea1').val(notes);
            if(imageUrl !="" && imageUrl !="https://kidzcorner.live"){
                $('#attachments_div').show();
                $('#attachments').attr('src', imageUrl);
                $('#download').attr('href', file);
            } else {
                $('#attachments_div').hide();
            }
            $('#myModal').modal('show');
        }

        // $(document).ready(function() {
        //     // Handle tab switching
        //     $('.nav-link').on('click', function() {
        //         var target = $(this).data('bs-target');
        //         $('.tab-pane').removeClass('show active');
        //         $(target).addClass('show active');
                
        //         // Update active state of tabs
        //         $('.nav-link').removeClass('active');
        //         $(this).addClass('active');
        //     });
        // });

        // Leaves view toggle functions
        function openLeavesTab(tabName) {
            if(tabName == 'calendar'){
                $('#leaves-calendar-tab').addClass('active');
                $('#leaves-list-tab').removeClass('active');
                
                $('#leaves-list-view').removeClass('active').hide();
                $('#leaves-calendar-view').addClass('active').show();
                $('#leaves-calendar-controls').show();
                
                // Initialize calendar if not already initialized
                if (!$('#leaves-calendar').data('calendar-initialized')) {
                    initializeLeavesCalendar();
                    $('#leaves-calendar').data('calendar-initialized', true);
                } else {
                    $('#leaves-calendar').fullCalendar('render');
                }
            } else {
                $('#leaves-list-tab').addClass('active');
                $('#leaves-calendar-tab').removeClass('active');
                
                $('#leaves-calendar-view').removeClass('active').hide();
                $('#leaves-list-view').addClass('active').show();
                $('#leaves-calendar-controls').hide();
            }
        }

        function dateShowLeaves(date){
            var currentUrl = window.location.href.split('?')[0];
            window.location.href = currentUrl + '?date=' + date;
        }

        let leavesTimeout;
        function submitLeavesFormWithDelay() {
            clearTimeout(leavesTimeout);
            leavesTimeout = setTimeout(function() {
                document.getElementById("leavesSearchForm").submit();
            }, 1000);
        }

        // Initialize calendar - matching index.blade.php exactly
        function initializeLeavesCalendar() {
            @php
                $calendarEvents = [];
                if(isset($leaves) && count($leaves) > 0) {
                    foreach($leaves as $leave) {
                        if(isset($leave->teacher) && $leave->teacher) {
                            $startDate = new \DateTime(date_format(date_create($leave->start_date), 'Y-m-d'));
                            $endDate = new \DateTime(date_format(date_create($leave->end_date), 'Y-m-d'));
                            
                            if($leave->duration == 'full_day'){
                                $title = $leave->leave_system ? $leave->teacher->name . " (1 Day ".$leave->leave_system->name.")" : ($leave->teacher->name ?? 'Leave');
                            } else {
                                $title = $leave->leave_system ? $leave->teacher->name . " (0.5 Day ".$leave->leave_system->name.")" : ($leave->teacher->name ?? 'Leave');
                            }
                            
                            $tempDate = clone $startDate;
                            while($tempDate <= $endDate) {
                                $calendarEvents[] = [
                                    'title' => $title,
                                    'start' => [
                                        'date' => $tempDate->format('Y-m-d') . ' 00:00:00'
                                    ]
                                ];
                                $tempDate->modify('+1 day');
                            }
                        }
                    }
                }
                $eventsJson = json_encode($calendarEvents);
            @endphp

            var events = <?php echo isset($eventsJson) && $eventsJson != '[]' ? $eventsJson : '[]'; ?>;

            var jsonData = JSON.parse(JSON.stringify(events));

            var data = jsonData.map(function(event) {
                var date = event.start.date.split(" ")[0];
                return {
                    title: event.title.trim(),
                    start: date
                };
            });

            // Month handling and current date
            var month = '{{ isset($_GET["date"]) ? $_GET["date"] : date("m") }}';
            var firstDateOfMonth = '{{ isset($_GET["date"]) ? date("Y-" . $_GET["date"] . "-01") : date("Y-m-d") }}';
            var currentDate = month ? firstDateOfMonth : '{{ date("Y-m-d") }}';

            let eventRenderCounter = 0;
            $('#leaves-calendar').fullCalendar({
                header: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'month,agendaWeek,agendaDay'
                },
                defaultDate: currentDate,
                editable: true,
                eventLimit: true,
                events: data,
                eventRender: function(event, element) {
                    if (eventRenderCounter % 2 === 0) {
                        element.find('.fc-content').addClass('color-even');
                    } else {
                        element.find('.fc-content').addClass('color-odd');
                    }
                    eventRenderCounter++;
                    element.find('.fc-title').html(event.title);
                },
                viewRender: function(view) {
                    // Add staffleaves-calender class (matching index.blade.php)
                    $('#leaves-calendar .fc-view-container').addClass('staffleaves-calender');
                }
            });
        }

        // Initialize on page load
        $(document).ready(function() {
            // Ensure controls are hidden in list view by default
            $('#leaves-calendar-controls').hide();
            
            // Check if we should show calendar view by default
            var urlParams = new URLSearchParams(window.location.search);
            var view = urlParams.get('view');
            if (view === 'calendar') {
                openLeavesTab('calendar');
            }
        });
    </script>
    
    <!-- FullCalendar Scripts -->
    <script src="https://fullcalendar.io/js/fullcalendar-2.4.0/lib/moment.min.js"></script>
    <script src="https://fullcalendar.io/js/fullcalendar-2.4.0/fullcalendar.min.js"></script>
@endsection
