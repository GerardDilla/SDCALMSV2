
<section role="main" class="content-body">
    <header class="page-header">
        <h2><i class="fa fa-tasks"></i> YOUR GRADES</h2>
    
        <div class="right-wrapper pull-right" style="padding-right:20px">
            <ol class="breadcrumbs">
                <li>
                    <a href="index.html">
                        <i class="fa fa-home"></i>
                    </a>
                </li>
                <li><span>Grades</span></li>
            </ol>
            <a class="sidebar-right-toggle"></a>
            
        </div>
    </header>
    <div id="particles-js"></div>
    <div class="row">
        <div class="col-md-6">
            <form id="grading_search_form" class="form-horizontal">
                <section class="panel shadowed-box">
                    <header class="panel-heading">
                        <div class="panel-actions">
                            <a href="#" class="fa fa-caret-down"></a>
                        </div>

                        <h2 class="panel-title">Search Record</h2>
                        <p class="panel-subtitle">
                            Search By Choosing the Schoolyear and Semester.
                        </p>
                    </header>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-md-3 control-label">School Year</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate" id="Grade_sy">

                                    <option selected value="">Select School Year</option>
                                    <option>2012-2013</option>
                                    <option>2014-2015</option>
                                    <option>2015-2016</option>
                                    <option>2017-2018</option>
                                    <option>2018-2019</option>
                                    <option>2019-2020</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label">Semester</label>
                            <div class="col-md-8">
                                <select data-plugin-selectTwo class="form-control populate"  id="Grade_sem">
                                    <option selected value="">Select Semester</option>
                                    <option value="FIRST">FIRST</option>
                                    <option value="SECOND">SECOND</option>
                                    <option value="SUMMER">SUMMER</option>
                                </select>
                            </div>
                        </div>
                        <div class="message_box">
                           
                        </div>
                    </div>
                    <footer class="panel-footer">
                        <button type="button" class="btn btn-default" id="Grade_finder">View Grades</button>
                        <button type="button" onclick="refresh_grading()" class="btn btn-default"><i class="fa fa-refresh"></i></button>
                        <span class="searchloader">
                            <img src="<?php echo base_url(); ?>assets/images/loading.gif"  height="42" width="42">
                        </span>
                    </footer>
                </section>
            </form>
        </div>

        <div class="col-md-6" style="padding:10px">
            <hr>
            <h3>Current School Year: <u>2019-2020</u></h3>
            <hr>
            <h3>Current Semester: <u>FIRST</u></h3>
            <hr>
        </div>

        <div class="col-md-12">
            <section class="panel shadowed-box">
                <div class="panel-body">
                <table class="table table-bordered table-striped mb-none" id="grading_main">
                    <thead>
                        <tr>
                            <th>Course Code</th>
                            <th>Course Title</th>
                            <th>Prelim</th>
                            <th>Midterm</th>
                            <th>Finals</th>
                            <th>Final Grade</th>
                            <th>Remarks</th>
                        </tr>
                    </thead>
                    <tbody id="grading_body">

                    </tbody>
                </table>
                </div>
            </section> 
        </div>

    </div>
  
</section>





 
