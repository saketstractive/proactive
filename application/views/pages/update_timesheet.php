<style type="text/css">
  .condensed > tbody > tr > td{
    padding: 1px 1px !important;
  }
  .pad-up-down{
    padding-top: 10px;
    padding-bottom: 10px;
  }
  .modal{
    max-height: 90% !important;
    width: 50% !important;
    overflow-y: visible !important;
    background-color: transparent !important;
    box-shadow: unset !important;
  }
  .inactive{
    position: relative !important;
    top: 0 !important;
    font-size: 15px; 
  }
</style>

<div class="modal" id="calenderModal">
            <div class="row transparent">
              <div class="col s10 m4 l4 ">
             <div id="weekModal" class="week-picker"></div> 
              </div>
              <div class="col s1 m1 l1">
                <button id="closeWeek" class="btn-floating">
                  <i class="fa fa-check"></i></button>
              </div>
            </div>
          </div>
<!-- MODAL ENDS -->
 <!-- Tap Target Structure -->
  <div class="tap-target" data-activates="btnWeekModal">
    <div class="tap-target-content white-text">
      <h5>Week Selector</h5>
      <p>Always start your timesheet by selecting week here. Some features are not available till you select a week in timehseet</p>
    </div>
  </div>
  <!-- Feature Discovery ends -->
        <div class="row center">
          <div class="col s10 m6 l6 ">
                    <!-- <br /><br /> -->
          <h6 class="green-text lighten-text-2 left-align">Welcome <?php echo $this->session->userdata('fullname'); ?></h6>            
          </div>

        </div>
        <div class="row">
          <div class="col s10 m10 l10">
            <h5 id="time-head" class="red-text">Timesheet </h5>
          </div>
          <div class="col s12 m12 l12">
            <hr>
          </div>
        </div>
        
        <!-- Update Timesheet Starts -->
        <div class="row" id="update-form">
          
      <div class="row card grey lighten-2 z-depth-3 pad-up-down">
        
         <div class="col s3 m3 l3">
          <button id="btnWeekModal" class="waves-effect waves-light btn btn-floating"><i class="fa fa-calendar"></i></button>
          <span id="startDate"></span> - <span id="endDate"></span> 
         </div>  
         <div class="col s3 m3 l3">
          <h5>Total Hours: <span id="totalHours" class="red-text">0</span> </h5>
         </div> 
         <div class="col s3 m3 l3">
          <div> <button id="btnAddRow" class="btn-floating"><i class="fa fa-plus red white-text"></i></button> <button id="btnDeleteRow" class="btn-floating"><i class="fa fa-minus red white-text"></i></button>
          </div>
         </div>
         <div class="col s3 m3 l3">
                  <a class="btn red" id="btn-update-timesheet" ><i class="fa fa-save"></i> Update</a> 
         </div>

        </div>
        <div class="col s12 m12 l12 card z-depth-3">
         <form id="form-update-timesheet">
          <table class="centered condensed">
            <thead>
              
              <tr>
                <th>Project</th>
                <th>Description</th>
                <th><span id="labelSunday">Sunday</span> <input type="hidden" id="inputSunday" name="Sunday"></th>
                <th><span id="labelMonday">Monday</span> <input type="hidden" id="inputMonday" name="Monday"></th>     
                <th><span id="labelTuesday">Tuesday</span> <input type="hidden" id="inputTuesday" name="Tuesday"></th>
                <th><span id="labelWednesday">Wednesday</span> <input type="hidden" id="inputWednesday" name="Wednesday"></th>
                <th><span id="labelThursday">Thursday</span> <input type="hidden" id="inputThursday" name="Thursday"></th>
                <th><span id="labelFriday">Friday</span> <input type="hidden" id="inputFriday" name="Friday"></th>
                <th><span id="labelSaturday">Saturday</span> <input type="hidden" id="inputSaturday" name="Saturday"></th>  
              </tr>
            </thead>
            <tbody id="table-append">
                <tr>
                  <td><div class="input-field"><select id="project1" name="project1"><?php echo $project_list; ?></select></div></td>
                  <td><div class="input-field"><textarea class="materialize-textarea" id="description1" name="description1" placeholder="Task Description"></textarea></div></td>
                  <td><input class="hoursToEnter center hourSunday" type="number" value='0' id="hourSunday1" name="hourSunday1"></td>
                  <td><input class="hoursToEnter center hourMonday" type="number" value='0' id="hourMonday1" name="hourMonday1"></td>
                  <td><input class="hoursToEnter center hourTuesday" type="number" value='0' id="hourTuesday1" name="hourTuesday1"></td>
                  <td><input class="hoursToEnter center hourWednesday" type="number" value='0' id="hourWednesday1" name="hourWednesday1"></td>
                  <td><input class="hoursToEnter center hourThursday" type="number" value='0' id="hourThursday1" name="hourThursday1"></td>
                  <td><input class="hoursToEnter center hourFriday" type="number" value='0' id="hourFriday1" name="hourFriday1"></td>
                  <td><input class="hoursToEnter center hourSaturday" type="number" value='0' id="hourSaturday1" name="hourSaturday1"></td>
                </tr>
                
            </tbody>
          </table>
            </form>

          
          <!-- <p class="red-text center-align" id="refresh-warning">There are some rows that are inserted, but not reflected. Please <a href="<?php echo site_url('user/update_timesheet');?>">Refresh</a> to get latest data <br />OR <br /> Fill up the remaining entries before you review the data.</p> -->
         <!--  <table class="striped centered data-table">
            <thead>
              <tr>
                <th>Date</th>
                <th>Billable Hours</th>
                <th>Work done</th>
                <th>Project</th>     
              </tr>
            </thead>
            <tbody>
            </tbody>
          </table> -->
          
        </div>
        
      </div>
      <div class="row card z-depth-3" style="padding: 10px;">
        <div class="col s12 m12 l12">        
          <table class="centered">
            <tr><td>Summary: </td><td class="grey-text"><b>Sub-Total</b></td><td id="SundayCount">0</td><td id="MondayCount">0</td><td id="TuesdayCount">0</td><td id="WednesdayCount">0</td><td id="ThursdayCount">0</td><td id="FridayCount">0</td><td id="SaturdayCount">0</td></tr>
            <tr><td></td><td class="grey-text"><b>Days</b></td><td class="grey-text">Sunday</td><td class="grey-text">Monday</td><td class="grey-text">Tuesday</td><td class="grey-text">Wednesday</td><td class="grey-text">Thursday</td><td class="grey-text">Friday</td><td class="grey-text">Saturday</td></tr>
       </table>
          
        </div>
        
      </div>
      <div class="row">
          <div class="col s12 m12 l12">
            <hr />
          </div>
        </div>
        </div>