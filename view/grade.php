<?php
session_start();
require_once "../controller/config.php";

if(!isset($_SESSION['unique_id'])){
    header("location: login.php");
}

if(!isset($_GET['student_unique_id'])){
    header("location: list_supervisee.php");
} else {
    $studentid = $_GET['student_unique_id'];
}

?>

<?php include_once "header.php"; ?>

<style>
    div.error-text{
        color: #721c24;
        padding: 8px 10px;
        text-align: center;
        border-radius: 5px;
        background: #f8d7da;
        border: 1px solid #f5c6cb;
        margin-bottom: 10px;
        display: none;
    }
</style>

<body>

<header class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#">Company name</a>
    <button class="navbar-toggler position-absolute d-md-none collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <label class="form-control form-control-dark w-100" style="text-align: center"><?php echo $_SESSION['roles']; ?></label>
    <div class="navbar-nav">
        <div class="nav-item text-nowrap">
            <a class="nav-link px-3" href="../controller/logout.php?logout_id=<?php echo $_SESSION['unique_id']; ?> ">Sign out</a>
        </div>
    </div>
</header>

<div class="container-fluid" >
    <div class="row">
        <?php
        if ($_SESSION['roles'] == "Admin")
        {
            require_once "nav_admin.php";
        }
        else if ($_SESSION['roles'] == "Lecturer")
        {
            require_once "nav_lecturer.php";
        }
        else if ($_SESSION['roles'] == "Student")
        {
            require_once "nav_student.php";
        }
        ?>

        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <div class="py-3 px-2">
                <div class="container-xl">

                    <?php
                        $sql = "SELECT * FROM student WHERE unique_id = {$studentid}";

                        $id='';
                        $unique_id ='';
                        $name='';
                        $programme ='';
                        $year='';
                        $fyp_title ='';
                        $supervisor_id ='';

                        $result = $conn ->query($sql);
                        if (!empty($result) && $result->num_rows > 0) {
                            $row  = mysqli_fetch_assoc($result);

                            $id = $row['id'];
                            $unique_id = $row['unique_id'];
                            $name = $row['name'];
                            $programme = $row['programme'];
                            $year = $row['year'];
                            $fyp_title = $row['fyp_title'];
                            $supervisor_id = $row['supervisor_unique_id'];
                        }
                    ?>

                    <div class="table-responsive">
                        <div class="table-wrapper">
                            <div class="table-title">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <h5>Grading</h5>
                                    </div>
                                </div>
                            </div>
                            <form class="needs-validation" id="grading_form" novalidate>
                                <div class="row g-2">
                                    <div class="col-sm-6">
                                        <label for="name" class="form-label">Student Name</label>
                                        <input type="text" class="form-control" id="name" value="<?php echo $name ?>" readonly>
                                    </div>

                                    <div class="col-sm-6">
                                        <label for="student_unique_id" class="form-label">Student ID</label>
                                        <input type="text" class="form-control" id="student_unique_id" name="student_unique_id" value="<?php echo $unique_id ?>" readonly>
                                    </div>

                                    <div class="col-12">
                                        <label for="year" class="form-label">Year</label>
                                        <input type="number" class="form-control" id="year" name="year" value="<?php echo $year?>" readonly>
                                    </div>

                                    <div class="col-12">
                                        <label for="programme" class="form-label">Programme</label>
                                        <input type="text" class="form-control" id="programme" name="programme" value="<?php echo $programme?>" readonly>
                                    </div>

                                    <div class="col-12">
                                        <label for="$fyp_title" class="form-label">FYP title</label>
                                        <input type="text" class="form-control" id="$fyp_title" name="$fyp_title" value="<?php echo $fyp_title?>" readonly>
                                    </div>

                                    <?php
                                    $supervisor_name ='';
                                    $sql2 = "SELECT * FROM `lecturer` WHERE unique_id = '".$supervisor_id."'" ;
                                    $result2 = $conn -> query($sql2);
                                    for ($i = 0; $i < mysqli_num_rows($result2); $i++) {
                                        $row2 = mysqli_fetch_assoc($result2);

                                        $supervisor_name = $row2['name'];
                                    }
                                    ?>
                                    <div class="col-12">
                                        <label for="supervisor_name" class="form-label">Supervisor Name</label>
                                        <input type="text" class="form-control" id="supervisor_name" name="supervisor_name" value="<?php echo $supervisor_name?>" readonly>
                                    </div>

                                    <div class="col-12">
                                        <label for="second_marker" class="form-label">Second Marker</label>
                                        <input type="text" class="form-control" id="second_marker" name="second_marker" value="" readonly>
                                    </div>
                                </div>

                                <hr/>
                                <table class="table table-striped table-hover w-auto">
                                    <thead>
                                    <tr>
                                        <th >Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Problem
                                            Statement &
                                            Relevance
                                            (20%)</td>
                                        <td>Problem Description,
                                            Aims and Objectives
                                            of project / research
                                            not defined, very
                                            vague and / or
                                            missing many
                                            elements.
                                            Not able to justify the
                                            relevance</td>
                                        <td>Problem Description,
                                            Aims and Objectives
                                            of project explained
                                            but lacking in details
                                            and ./ or clarity
                                            Barely able to justify
                                            the relevance of the
                                            project</td>
                                        <td>Problem Description,
                                            Aims and Objectives
                                            of project explained
                                            adequately but lack
                                            discussion
                                            Able to justify the
                                            relevance of the
                                            project with some
                                            supporting evidence</td>
                                        <td>Problem Description,
                                            Aims and Objectives
                                            of project delineated
                                            excellently providing
                                            strong justification of
                                            the relevance of the
                                            project</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="pro_stmt" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="pro_stmt_comment" rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr/>
                                <table class="table table-striped table-hover w-auto">
                                    <thead>
                                    <tr>
                                        <th >Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Literature
                                            Review,
                                            Research
                                            Methods and
                                            Outcomes (20%)</td>
                                        <td>Missing either one
                                            or more research
                                            components and
                                            outcomes
                                            Conducted research
                                            but no expected
                                            outcomes or
                                            outcomes were
                                            insignificant
                                            Irrelevant research
                                            was done</td>
                                        <td>Basic, relevant
                                            research done and
                                            outcomes presented.
                                            Outcomes had some
                                            significance to the
                                            project though not
                                            obvious</td>
                                        <td>Adequate, relevant
                                            research done and
                                            corresponding
                                            outcomes presented
                                            that were
                                            conceptually
                                            purposeful and
                                            clearly significant to
                                            the project</td>
                                        <td>Excellent yet
                                            relevant research
                                            with practically
                                            oriented and
                                            conceptually
                                            purposeful outcomes
                                            derived therein
                                            which were
                                            outstandingly
                                            significant to the
                                            project</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="lit_review" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="lit_review_comment" rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr/>
                                <table class="table table-striped table-hover w-auto" >
                                    <thead>
                                    <tr>
                                        <th >Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Analysis and
                                            Design
                                            (20%)</td>
                                        <td>No obvious
                                            relationship between
                                            aims, objectives,
                                            research and
                                            findings.
                                            Hardly any designs
                                            were created
                                            thereafter. Great
                                            deal of errors and /
                                            or omissions</td>
                                        <td>Some relationship
                                            between aims,
                                            objectives, research
                                            and findings but
                                            these barely led to
                                            the design of the
                                            artefact.
                                            Many errors and / or
                                            omissions noted</td>
                                        <td>Some obvious
                                            relationship between
                                            the aims, objectives,
                                            research and
                                            findings that leads to
                                            the design of the
                                            artefact. Some errors
                                            and / or omissions
                                            noted</td>
                                        <td>Clear synthesis
                                            between aims,
                                            objectives, research,
                                            and findings that
                                            leads to the design
                                            of the artefact with
                                            hardly any errors /
                                            omissions</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="analysis_design" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="analysis_design_comment" rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr/>
                                <table class="table table-striped table-hover w-auto">
                                    <thead>
                                    <tr>
                                        <th >Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Implementation
                                            and Testing
                                            (20%)</td>
                                        <td>No artefact /
                                            working system
                                            produced or
                                            requirements
                                            specified in TOR
                                            hardly met
                                            Poor selection and
                                            inappropriate use of
                                            development tools
                                            and methodologies
                                            No record of testing
                                            done</td>
                                        <td>Minimal
                                            requirements
                                            specified in TOR
                                            met
                                            Artefact / Working
                                            system produced
                                            with obvious
                                            limitations,
                                            omissions and / or
                                            errors
                                            Appropriate use of
                                            basic yet relevant
                                            development tools
                                            and methodologies
                                            Basic testing done
                                            and recorded</td>
                                        <td>Most requirements
                                            specified in TOR
                                            met
                                            Artefact / Working
                                            system produced
                                            with minor
                                            limitations,
                                            omissions and / or
                                            errors
                                            Appropriate use of
                                            advanced features
                                            of development
                                            tools and
                                            methodologies
                                            Adequate testing
                                            done and recorded</td>
                                        <td>All requirements
                                            specified in TOR
                                            met
                                            Artefact / Working
                                            system produced
                                            with hardly any
                                            limitations,
                                            omissions and / or
                                            errors
                                            Excellent
                                            demonstration of
                                            using advanced
                                            features of
                                            development tools
                                            and methodologies
                                            Detailed testing
                                            done and recorded
                                            with discussion</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="imple_test" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="imple_test_comment" rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr/>
                                <table class="table table-striped table-hover w-auto">
                                    <thead>
                                    <tr>
                                        <th>Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Project
                                            Management
                                            (20%)</td>
                                        <td>Missed most
                                            datelines
                                            Failed to report
                                            project progress
                                            Irregular meetings
                                            with supervisor</td>
                                        <td>Missed some
                                            datelines
                                            Basic and periodical
                                            reporting of project
                                            progress
                                            Obligatory meetings
                                            with supervisor</td>
                                        <td>Met most datelines
                                            Clear and regular
                                            reporting of project
                                            progress
                                            Regular meetings
                                            with supervisor to
                                            seek assistance</td>
                                        <td>All datelines met
                                            ahead of time
                                            In depth and
                                            proactive reporting
                                            of project progress
                                            Proactive meetings
                                            with supervisor to
                                            engage in
                                            meaningful
                                            discussions</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="pro_mange" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="pro_mange_comment" rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr/>
                                <table class="table table-striped table-hover w-auto">
                                    <thead>
                                    <tr>
                                        <th >Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Conclusion,
                                            Product / Process
                                            Evaluation and
                                            Recommendation
                                            (20%)</td>
                                        <td>Conclusions did not
                                            relate to aims,
                                            objectives and
                                            experience drawn
                                            from project
                                            Missing evaluation
                                            of product and / or
                                            process
                                            Recommendations
                                            are impractical,
                                            blasé, mistaken or
                                            thoughtless.</td>
                                        <td>Conclusions relate
                                            briefly to aims,
                                            objectives and / or
                                            experience drawn
                                            from project
                                            Some evaluation of
                                            product and / or
                                            process but was
                                            merely mentioned /
                                            stated
                                            Minimal practical
                                            and creative
                                            recommendations
                                            based firmly on
                                            evidence presented.</td>
                                        <td>Conclusions relate
                                            well to aims,
                                            objectives and / or
                                            experience drawn
                                            from project
                                            Good discussion on
                                            the evaluation of
                                            product and process
                                            Good practical and
                                            creative
                                            recommendations
                                            based firmly on
                                            evidence presented.</td>
                                        <td>Insightful
                                            conclusion that
                                            synthesises the aims,
                                            objectives and
                                            experience drawn
                                            from project
                                            Insightful yet critical
                                            evaluation of
                                            product and process
                                            Superbly practical
                                            and creative
                                            recommendations
                                            based firmly on
                                            evidence presented.</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="conclusion" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="conclusion_comment" rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>

                                <hr/>
                                <table class="table table-striped table-hover w-auto">
                                    <thead>
                                    <tr>
                                        <th>Criteria</th>
                                        <th>Poor(0-9)</th>
                                        <th>Average(10-12)</th>
                                        <th>Good(13-15)</th>
                                        <th>Excellent(16-20)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>Documentation
                                            and Viva
                                            (20%)</td>
                                        <td>Poorly structured
                                            documentation –
                                            failed to meet
                                            minimum
                                            requirements
                                            Many missing
                                            chapters / portions
                                            of the
                                            documentation
                                            References were
                                            either non-existent,
                                            did not adhere to
                                            referencing style or
                                            were outdated
                                            Did not turn up for
                                            viva
                                            Not able provide
                                            answers to questions
                                            related to the project</td>
                                        <td>Documentation
                                            structure meets
                                            minimum
                                            requirements
                                            Some missing
                                            chapters / portions
                                            of the
                                            documentation
                                            Not able to present
                                            work done during
                                            viva
                                            References were
                                            done but
                                            insufficient,
                                            inconsistent
                                            referencing style and
                                            some outdated
                                            references
                                            Able to answer
                                            some questions
                                            related to the project</td>
                                        <td>Documentation
                                            structure sufficiently
                                            meets requirements
                                            No missing chapters
                                            / portions of the
                                            documentation
                                            Able to present
                                            briefly work done
                                            during viva
                                            References were
                                            done but with minor
                                            errors
                                            Able to answer most
                                            questions related to
                                            the project</td>
                                        <td>Documentation
                                            structure sufficiently
                                            meets requirements
                                            No missing chapters
                                            / portions of the
                                            documentation
                                            Able to present
                                            briefly work done
                                            during viva
                                            References were
                                            done but with minor
                                            errors
                                            Able to answer most
                                            questions related to
                                            the project</td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Marks</td>
                                        <td colspan="4"><input class="form-control" name="doc_viva" type="number"/></td>
                                        <td></td>
                                    </tr>
                                    <tr>
                                        <td>Comments</td>
                                        <td colspan="4"><textarea class="form-control" name="doc_viva_comment"  rows="5"></textarea></td>
                                        <td></td>
                                    </tr>
                                    </tbody>
                                </table>


                                <hr class="my-4">

                                <div class="error-text" id="error_text"></div>
                                <button class="w-100 btn btn-primary btn-lg" id="btnSubmit" type="submit">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>

        </main>


    </div>
</div>

<script src="../assets/javascript/add_grade.js"></script>

<script src="../assets/javascript/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js" integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous"></script><script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js" integrity="sha384-zNy6FEbO50N+Cg5wap8IKA4M/ZnLJgzc6w2NqACZaK0u0FXfOWRRJOnQtpZun8ha" crossorigin="anonymous"></script><script src="../assets/javascript/dashboard.js"></script>

<script>
    $(document).ready(function(){
        // NavBar Active
        $('a.active').removeClass('active');
        var url = window.location.pathname;
        var filename = url.substring(url.lastIndexOf('/')+1);
        $('a[href$="' + filename + '"]').addClass('active');
    });
</script>

</body>

</html>
