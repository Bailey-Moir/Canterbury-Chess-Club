<?php
    if(!isset($_SESSION['logged_in'])) {
        header("Location: /signin");
    }

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=?");
    $stmt->bind_param("s", $_GET['name']);
    $stmt->execute();
    $user_results = $stmt->get_result()->fetch_assoc();
?>
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div id="content" class="content content-full-width">
            <!-- begin profile -->
            <div class="profile">
                <div class="profile-header">
                    <!-- BEGIN profile-header-cover --> 
                    <div class="profile-header-cover"></div>
                    <!-- END profile-header-cover -->
                    <!-- BEGIN profile-header-content -->
                    <div class="profile-header-content">
                        <!-- BEGIN profile-header-img -->
                        <div class="profile-header-img">
                        <img src="/res/avatar.png" alt="standard avatar icon">
                        </div>
                        <!-- END profile-header-img -->
                        <!-- BEGIN profile-header-info -->
                        <div class="profile-header-info">
                        <h4 class="m-t-10 m-b-5"><?php echo $user_results['username'] ?></h4>
                        <p class="m-b-10">Full Name</p>
                        <a href="#" class="btn btn-sm btn-info mb-2">Edit Profile</a>
                        </div>
                        <!-- END profile-header-info -->
                    </div>
                    <!-- END profile-header-content -->
                    <!-- BEGIN profile-header-tab -->
                    <ul class="profile-header-tab nav nav-tabs">
                        <?php                 
                        $pages = array("games", "tournaments");
                        foreach ($pages as &$page) { 
                            ?>
                            <li class="nav-item"><a href="/account?id=<?php echo $_GET['id']; ?>&page=<?php echo $page; ?>"  class="nav-link_"><?php echo strtoupper($page); ?></a></li>
                            <?php 
                        }
                        ?>
                    
                    </ul>
                    <!-- END profile-header-tab -->
                </div>

            </div>
            <!-- end profile -->

            <!-- being profile content -->
            <div class="profile-content">
                <?php
                if ($_GET["acc_page"] == "about") {
                    //
                }
                ?>
                    <!-- begin tab-content -->
                    <div class="tab-content p-0">
                        <!-- begin #profile-about tab -->
                        <div class="tab-pane fade in active show" id="profile-about">
                            <!-- begin table -->
                            <div class="table-responsive">
                                <table class="table table-profile">
                                <thead>
                                    <tr>
                                        <th></th>
                                        <th>
                                            <h4><?php echo $user_results['username'] ?><small>Full Name</small></h4>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="highlight">
                                        <td class="field">Mood</td>
                                        <td><a href="javascript:;">Add Mood Message</a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Mobile</td>
                                        <td><i class="fa fa-mobile fa-lg m-r-5"></i> +1-(847)- 367-8924 <a href="javascript:;" class="m-l-5">Edit</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Home</td>
                                        <td><a href="javascript:;">Add Number</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Office</td>
                                        <td><a href="javascript:;">Add Number</a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">About Me</td>
                                        <td><a href="javascript:;">Add Description</a></td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Federation</td>
                                        <td>
                                            <select class="form-control input-inline input-xs" name="region">
                                            <option value="US" selected="">New Zealand</option>
                                            <option value="AF">Afghanistan</option>
                                            <option value="AL">Albania</option>
                                            <option value="DZ">Algeria</option>
                                            <option value="AS">American Samoa</option>
                                            <option value="AD">Andorra</option>
                                            <option value="AO">Angola</option>
                                            <option value="AI">Anguilla</option>
                                            <option value="AQ">Antarctica</option>
                                            <option value="AG">Antigua and Barbuda</option>
                                            <option value="AR">Argentina</option>
                                            <option value="AM">Armenia</option>
                                            <option value="AW">Aruba</option>
                                            <option value="AU">Australia</option>
                                            <option value="AT">Austria</option>
                                            <option value="AZ">Azerbaijan</option>
                                            <option value="BS">Bahamas</option>
                                            <option value="BH">Bahrain</option>
                                            <option value="BD">Bangladesh</option>
                                            <option value="BB">Barbados</option>
                                            <option value="BY">Belarus</option>
                                            <option value="BE">Belgium</option>
                                            <option value="BZ">Belize</option>
                                            <option value="BJ">Benin</option>
                                            <option value="BM">Bermuda</option>
                                            <option value="BT">Bhutan</option>
                                            <option value="BO">Bolivia</option>
                                            <option value="BA">Bosnia and Herzegovina</option>
                                            <option value="BW">Botswana</option>
                                            <option value="BV">Bouvet Island</option>
                                            <option value="BR">Brazil</option>
                                            <option value="IO">British Indian Ocean Territory</option>
                                            <option value="BN">Brunei Darussalam</option>
                                            <option value="BG">Bulgaria</option>
                                            <option value="BF">Burkina Faso</option>
                                            <option value="BI">Burundi</option>
                                            <option value="KH">Cambodia</option>
                                            <option value="CM">Cameroon</option>
                                            <option value="CA">Canada</option>
                                            <option value="CV">Cape Verd</option>
                                            <option value="KY">Cayman Islands</option>
                                            <option value="CF">Central African Republic</option>
                                            <option value="TD">Chad</option>
                                            <option value="CL">Chile</option>
                                            <option value="CN">China</option>
                                            <option value="CX">Christmas Island</option>
                                            <option value="CC">Cocos (Keeling) Islands</option>
                                            <option value="CO">Colombia</option>
                                            <option value="KM">Comoros</option>
                                            <option value="CG">Congo</option>
                                            <option value="CD">Congo (DRC)</option>
                                            <option value="CK">Cook Islands</option>
                                            <option value="CR">Costa Rica</option>
                                            <option value="CI">Cote D'Ivoire</option>
                                            <option value="HR">Croatia</option>
                                            <option value="CU">Cuba</option>
                                            <option value="CY">Cyprus</option>
                                            <option value="CZ">Czech Republic</option>
                                            <option value="DK">Denmark</option>
                                            <option value="DJ">Djibouti</option>
                                            <option value="DM">Dominica</option>
                                            <option value="DO">Dominican Republic</option>
                                            <option value="EC">Ecuador</option>
                                            <option value="EG">Egypt</option>
                                            <option value="SV">El Salvador</option>
                                            <option value="GQ">Equatorial Guinea</option>
                                            <option value="ER">Eritrea</option>
                                            <option value="EE">Estonia</option>
                                            <option value="ET">Ethiopia</option>
                                            <option value="FK">Falkland Islands (Malvinas)</option>
                                            <option value="FO">Faroe Islands</option>
                                            <option value="FJ">Fiji</option>
                                            <option value="FI">Finland</option>
                                            <option value="FR">France</option>
                                            <option value="GF">French Guiana</option>
                                            <option value="PF">French Polynesia</option>
                                            <option value="TF">French Southern Territories</option>
                                            <option value="GA">Gabon</option>
                                            <option value="GM">Gambia</option>
                                            <option value="GE">Georgia</option>
                                            <option value="DE">Germany</option>
                                            <option value="GH">Ghana</option>
                                            <option value="GI">Gibraltar</option>
                                            <option value="GR">Greece</option>
                                            <option value="GL">Greenland</option>
                                            <option value="GD">Grenada</option>
                                            <option value="GP">Guadeloupe</option>
                                            <option value="GU">Guam</option>
                                            <option value="GT">Guatemala</option>
                                            <option value="GN">Guinea</option>
                                            <option value="GW">Guinea-Bissau</option>
                                            <option value="GY">Guyana</option>
                                            <option value="HT">Haiti</option>
                                            <option value="HM">Heard Island and Mcdonald Islands</option>
                                            <option value="VA">Holy See (Vatican City State)</option>
                                            <option value="HN">Honduras</option>
                                            <option value="HK">Hong Kong</option>
                                            <option value="HU">Hungary</option>
                                            <option value="IS">Iceland</option>
                                            <option value="IN">India</option>
                                            <option value="ID">Indonesia</option>
                                            <option value="IR">Iran</option>
                                            <option value="IQ">Iraq</option>
                                            <option value="IE">Ireland</option>
                                            <option value="IL">Israel</option>
                                            <option value="IT">Italy</option>
                                            <option value="JM">Jamaica</option>
                                            <option value="JP">Japan</option>
                                            <option value="JO">Jordan</option>
                                            <option value="KZ">Kazakhstan</option>
                                            <option value="KE">Kenya</option>
                                            <option value="KI">Kiribati</option>
                                            <option value="KR">South Korea</option>
                                            <option value="KW">Kuwait</option>
                                            <option value="KG">Kyrgyzstan</option>
                                            <option value="LA">Laos</option>
                                            <option value="LV">Latvia</option>
                                            <option value="LB">Lebanon</option>
                                            <option value="LS">Lesotho</option>
                                            <option value="LR">Liberia</option>
                                            <option value="LY">Libya</option>
                                            <option value="LI">Liechtenstein</option>
                                            <option value="LT">Lithuania</option>
                                            <option value="LU">Luxembourg</option>
                                            <option value="MO">Macao</option>
                                            <option value="MK">Macedonia</option>
                                            <option value="MG">Madagascar</option>
                                            <option value="MW">Malawi</option>
                                            <option value="MY">Malaysia</option>
                                            <option value="MV">Maldives</option>
                                            <option value="ML">Mali</option>
                                            <option value="MT">Malta</option>
                                            <option value="MH">Marshall Islands</option>
                                            <option value="MQ">Martinique</option>
                                            <option value="MR">Mauritania</option>
                                            <option value="MU">Mauritius</option>
                                            <option value="YT">Mayotte</option>
                                            <option value="MX">Mexico</option>
                                            <option value="FM">Micronesia</option>
                                            <option value="MD">Moldova</option>
                                            <option value="MC">Monaco</option>
                                            <option value="MN">Mongolia</option>
                                            <option value="MS">Montserrat</option>
                                            <option value="MA">Morocco</option>
                                            <option value="MZ">Mozambique</option>
                                            <option value="MM">Myanmar</option>
                                            <option value="NA">Namibia</option>
                                            <option value="NR">Nauru</option>
                                            <option value="NP">Nepal</option>
                                            <option value="NL">Netherlands</option>
                                            <option value="NC">New Caledonia</option>
                                            <option value="NZ">New Zealand</option>
                                            <option value="NI">Nicaragua</option>
                                            <option value="NE">Niger</option>
                                            <option value="NE">Nigeria</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">City</td>
                                        <td>Canterbury</td>
                                    </tr>
                                    <tr>
                                        <td class="field">State</td>
                                        <td><a href="javascript:;">Add State</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Website</td>
                                        <td><a href="javascript:;">Add Webpage</a></td>
                                    </tr>
                                    <tr>
                                        <td class="field">Gender</td>
                                        <td>
                                            <select class="form-control input-inline input-xs" name="gender">
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Birthdate</td>
                                        <td>
                                            <select class="form-control input-inline input-xs" name="day">
                                            <option value="04" selected="">04</option>
                                            </select>
                                            -
                                            <select class="form-control input-inline input-xs" name="month">
                                            <option value="11" selected="">11</option>
                                            </select>
                                            -
                                            <select class="form-control input-inline input-xs" name="year">
                                            <option value="1989" selected="">1989</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="field">Language</td>
                                        <td>
                                            <select class="form-control input-inline input-xs" name="language">
                                            <option value="" selected="">English</option>
                                            </select>
                                        </td>
                                    </tr>
                                    <tr class="divider">
                                        <td colspan="2"></td>
                                    </tr>
                                    <tr class="highlight">
                                        <td class="field">&nbsp;</td>
                                        <td class="p-t-10 p-b-10">
                                            <button type="submit" class="btn btn-primary width-150">Update</button>
                                            <button type="submit" class="btn btn-white btn-white-without-border width-150 m-l-5">Cancel</button>
                                        </td>
                                    </tr>
                                </tbody>
                                </table>
                            </div>
                            <!-- end table -->
                        </div>
                        <!-- end #profile-about tab -->
                    </div>
                    <!-- end tab-content -->
                    </div>
                    <!-- end profile-content -->
                </div>
            </div>
        </div>
    </div>
</div>
 


            <!-- begin profile-content -->
            <div class="profile-content">

                <?php
                if ($_GET["acc_page"] == "forums") {
                    //
                }
                ?>
                <!-- begin tab-content -->
                <div class="tab-content p-0">
                    <!-- begin #profile-post tab -->
                    <div class="tab-pane fade active show" id="profile-post">
                        <!-- begin timeline -->
                        <ul class="timeline">
                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">today</span>
                                <span class="time">04:20</span>
                            </div>
                            <!-- end timeline-time -->
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
                            <!-- end timeline-icon -->
                            <!-- begin timeline-body -->
                            <div class="timeline-body">
                                <div class="timeline-header">
                                    <span class="userimage"><img src="/res/avatar.png" alt="Standard icon images"></span>
                                    <span class="username"><a href="javascript:;"><?php echo $user_results['username'] ?></a> <small></small></span>
                                    <span class="pull-right text-muted">18 Views</span>
                                </div>
                                <div class="timeline-content">
                                    <p>
                                    Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nunc faucibus turpis quis tincidunt luctus.
                                    Nam sagittis dui in nunc consequat, in imperdiet nunc sagittis.
                                    </p>
                                </div>
                                <div class="timeline-likes">
                                    <div class="stats-right">
                                    <span class="stats-text">259 Shares</span>
                                    <span class="stats-text">21 Comments</span>
                                    </div>
                                    <div class="stats">
                                    <span class="fa-stack fa-fw stats-icon">
                                    <i class="fa fa-circle fa-stack-2x text-danger"></i>
                                    <i class="fa fa-heart fa-stack-1x fa-inverse t-plus-1"></i>
                                    </span>
                                    <span class="fa-stack fa-fw stats-icon">
                                    <i class="fa fa-circle fa-stack-2x text-primary"></i>
                                    <i class="fa fa-thumbs-up fa-stack-1x fa-inverse"></i>
                                    </span>
                                    <span class="stats-total">4.3k</span>
                                    </div>
                                </div>
                                <div class="timeline-footer">
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                </div>
                                <div class="timeline-comment-box">
                                    <div class="user"><img src="/res/avatar.png">Standard icon images</div>
                                    <div class="input">
                                    <form action="">
                                        <div class="input-group">
                                            <input type="text" class="form-control rounded-corner" placeholder="Write a comment...">
                                            <span class="input-group-btn p-l-10">
                                            <button class="btn btn-primary f-s-12 rounded-corner" type="button">Comment</button>
                                            </span>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                            </div>
                            <!-- end timeline-body -->
                        </li>
                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">yesterday</span>
                                <span class="time">20:17</span>
                            </div>
                            <!-- end timeline-time -->
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
                            <!-- end timeline-icon -->
                            <!-- begin timeline-body -->
                            <div class="timeline-body">
                                <div class="timeline-header">
                                    <span class="userimage"><img src="/res/avatar.png" alt="Standard icon images"></span>
                                    <span class="username"><?php echo $user_results['username'] ?></span>
                                    <span class="pull-right text-muted">82 Views</span>
                                </div>
                                <div class="timeline-content">
                                    <p>Location: United States</p>
                                </div>
                                <div class="timeline-footer">
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                </div>
                            </div>
                            <!-- end timeline-body -->
                        </li>
                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">24 February 2014</span>
                                <span class="time">08:17</span>
                            </div>
                            <!-- end timeline-time -->
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
                            <!-- end timeline-icon -->
                            <!-- begin timeline-body -->
                            <div class="timeline-body">
                                <div class="timeline-header">
                                    <span class="userimage"><img src="/res/avatar.png" alt="Standard icon images"></span>
                                    <span class="username"><?php echo $user_results['username'] ?></span>
                                    <span class="pull-right text-muted">1,282 Views</span>
                                </div>
                                <div class="timeline-content">
                                    <p class="lead">
                                    <i class="fa fa-quote-left fa-fw pull-left"></i>
                                    Quisque sed varius nisl. Nulla facilisi. Phasellus consequat sapien sit amet nibh molestie placerat. Donec nulla quam, ullamcorper ut velit vitae, lobortis condimentum magna. Suspendisse mollis in sem vel mollis.
                                    <i class="fa fa-quote-right fa-fw pull-right"></i>
                                    </p>
                                </div>
                                <div class="timeline-footer">
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                </div>
                            </div>
                            <!-- end timeline-body -->
                        </li>
                        <li>
                            <!-- begin timeline-time -->
                            <div class="timeline-time">
                                <span class="date">10 January 2014</span>
                                <span class="time">20:43</span>
                            </div>
                            <!-- end timeline-time -->
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
                            <!-- end timeline-icon -->
                            <!-- begin timeline-body -->
                            <div class="timeline-body">
                                <div class="timeline-header">
                                    <span class="userimage"><img src="/res/avatar.png" alt="">Standard icon images</span>
                                    <span class="username"><?php echo $user_results['username'] ?></span>
                                    <span class="pull-right text-muted">1,021,282 Views</span>
                                </div>
                                <div class="timeline-content">
                                    <h4 class="template-title">
                                    <i class="fa fa-map-marker text-danger fa-fw"></i>
                                    795 Folsom Ave, Suite 600 San Francisco, CA 94107
                                    </h4>
                                    <p>In hac habitasse platea dictumst. Pellentesque bibendum id sem nec faucibus. Maecenas molestie, augue vel accumsan rutrum, massa mi rutrum odio, id luctus mauris nibh ut leo.</p>
                                    <p class="m-t-20">
                                    <img src="../assets/img/gallery/gallery-5.jpg" alt="">
                                    </p>
                                </div>
                                <div class="timeline-footer">
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-thumbs-up fa-fw fa-lg m-r-3"></i> Like</a>
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-comments fa-fw fa-lg m-r-3"></i> Comment</a> 
                                    <a href="javascript:;" class="m-r-15 text-inverse-lighter"><i class="fa fa-share fa-fw fa-lg m-r-3"></i> Share</a>
                                </div>
                            </div>
                            <!-- end timeline-body -->
                        </li>
                        <li>
                            <!-- begin timeline-icon -->
                            <div class="timeline-icon">
                                <a href="javascript:;">&nbsp;</a>
                            </div>
                            <!-- end timeline-icon -->
                            <!-- begin timeline-body -->
                            <div class="timeline-body">
                                Loading...
                            </div>
                            <!-- begin timeline-body -->
                        </li>
                        </ul>
                        <!-- end timeline -->
                    </div>
                    <!-- end #profile-post tab -->
                </div>
                <!-- end tab-content -->
            </div>
            <!-- end profile-content -->
            </div>
        </div>
    </div>
</div>
<?php 
    if ($_GET['acc_page'] == "forums") require PATH."/src/modules/footer/sticky-footer.php";
    else require PATH."/src/modules/footer/footer.php";
?>