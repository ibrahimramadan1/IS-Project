var deliverables = 0;
function addDeliverable() {
    $('.deliverablesDetails').append(
        `<div class="input-group mb-3" id="${deliverables}">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Deliverable</span>
          <button onclick="remove(${deliverables++})" class="btn s btn-danger">-</button>
        </div>
        <input type="text" class="form-control" placeholder="Deliverable Name">
      </div>`
    );
}
function addWorker() {
    $('.workersDetails').append(
        `<div class="WorkerDetails" id="${deliverables}">
        <h3><button onclick="remove(${deliverables++})" class="btn s btn-danger">-</button> Worker</h3>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Worker Name</span>
            </div>
            <input type="text" class="form-control" placeholder="Worker Name">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Worker Title</span>
            </div>
            <input type="text" class="form-control" placeholder="Worker title">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Hours/Day</span>
            </div>
            <input type="number" class="form-control" placeholder="Hours each day">
        </div>
    </div>`
    );
}
function remove(id) {
    $('#'+id).remove();
}
function removesub(id) {
    $('#'+id).parents('.task').find('.counter').val(id-1);
    console.log($('#'+id).parent().parent().find('.counter').val());
    $('#'+id).remove();
}
$('.addTask').click(function () { 
    $(this).parent('.deliverableData').children('.tasks').append(
        `
        <div class="task" id="${deliverables}">
        <input name="NoST[]" type="number" class="counter"  value="0" style="display:none">
        <h2><button type="button" onclick="remove(${deliverables++})" class="removeTask btn-danger btn">-</button> Task </h2>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Task Name</span>
            </div>
            <input name="Tname[]" type="Text" class="form-control" placeholder="Task Name">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Start Data</span>
            </div>
            <input name="Sdate[]" type="Date" class="form-control startDate" placeholder="Hours">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text"  id="basic-addon1">Working Days</span>
            </div>
            <input name="Whrs[]" type="number" class="form-control workingHours" placeholder="Days">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Due Date</span>
            </div>
            <input name="Ddate[]" type="Date" class="form-control dueDate" placeholder="Hours">
        </div>
        <select name="mileStone[]" style="margin-right: 0px !important;" class="custom-select mr-sm-2" id="inlineFormCustomSelect">
                        <option value="yes">yes</option>
                        <option value="no">no</option>
                        </select>
        <div class="subTasks">
            <div class="sub" style="margin-bottom: 5px;">
                 Sub Tasks : 
             </div>
            <button type="button" class="addSub btn btn-success" style="margin-top:-5px">Add Sub Task</button>
        </div>
        
    </div>`
    );
});
$(document).on('change','.substartDate',function () {
    subTaskStart = $(this).parents('.subTask').find('.substartDate').val();
    taskStart = $(this).parents('.task').find('.startDate').val();
    taskFinish = $(this).parents('.task').find('.dueDate').val();
    subTaskFinish = $(this).parents('.subTask').find('.subdueDate').val();
    subWorkinghours = $(this).parents('.subTask').find('.subworkingHours').val();
    ms = new Date(taskStart);
    ss = new Date(subTaskStart);
    mf = new Date(taskFinish);
    sf = new Date(subTaskFinish);
    if(subWorkinghours!=""){
        $(this).parents('.subTask').find('.subdueDate').val(addDays(subTaskStart,subWorkinghours));
        if (sf>mf){
            $(this).parents('.subTask').find('.subdueDate').val(taskFinish);
            $(this).parents('.subTask').find('.subworkingHours').val(0);
        }
    }
    if (ss<ms)$(this).val(taskStart);
    if (sf>mf)$(this).parents('.subTask').find('.subdueDate').val(taskFinish);
    if (ss>mf)$(this).val(taskStart);
    if (sf<ms)$(this).parents('.subTask').find('.subdueDate').val(taskFinish);
});
$(document).on('keyup','.subworkingHours',function () {
    subTaskStart = $(this).parents('.subTask').find('.substartDate').val();
    taskStart = $(this).parents('.task').find('.startDate').val();
    taskFinish = $(this).parents('.task').find('.dueDate').val();
    subTaskFinish = $(this).parents('.subTask').find('.subdueDate').val();
    subWorkinghours = $(this).val();
    ms = new Date(taskStart);
    ss = new Date(subTaskStart);
    mf = new Date(taskFinish);
    sf = new Date(subTaskFinish);
    if(subWorkinghours!=""){
        $(this).parents('.subTask').find('.subdueDate').val(addDays(subTaskStart,subWorkinghours));
        console.log(mf);
        console.log(subTaskFinish);
    }
    subTaskStart = $(this).parents('.subTask').find('.substartDate').val();
    taskStart = $(this).parents('.task').find('.startDate').val();
    taskFinish = $(this).parents('.task').find('.dueDate').val();
    subTaskFinish = $(this).parents('.subTask').find('.subdueDate').val();
    subWorkinghours = $(this).val();
    ms = new Date(taskStart);
    ss = new Date(subTaskStart);
    mf = new Date(taskFinish);
    sf = new Date(subTaskFinish);
    if (ss<ms)$(this).val(taskStart);
    if (sf>mf)$(this).parents('.subTask').find('.subdueDate').val(taskFinish);
    if (ss>mf)$(this).val(taskStart);
    if (sf<ms)$(this).parents('.subTask').find('.subdueDate').val(taskFinish);
});

$(document).on('change','.startDate', function () {
    var workingHours = $(this).parents('.task').find('.workingHours').val();
    var startDate = $(this).parents('.task').find('.startDate').val();
    var dueDate = $(this).parents('.task').find('.dueDate').val();
    if (workingHours !="")
    $(this).parents('.task').find('.dueDate').val(addDays(startDate,workingHours));
    
});
$(document).on('change','.workingHours', function () {
    var workingHours = $(this).parents('.task').find('.workingHours').val();
    var startDate = $(this).parents('.task').find('.startDate').val();
    var dueDate = $(this).parents('.task').find('.dueDate').val();
    if (startDate !="")
    $(this).parents('.task').find('.dueDate').val(addDays(startDate,workingHours));
    
});
$(document).on('change','.dueDate', function () {
    var workingHours = $(this).parents('.task').find('.workingHours').val();
    var startDate = $(this).parents('.task').find('.startDate').val();
    var dueDate = $(this).parents('.task').find('.dueDate').val();
    if (workingHours !="")
    $(this).parents('.task').find('.startDate').val(subDays(dueDate,workingHours));
    
});
$(document).on('click','.addSub',function () {
    var val = $(this).parents('.task').find(".counter").val();
    val++;
    $(this).parents('.task').find(".counter").val(val);
    console.log(val);
    $(this).siblings('.sub').append(
    `<div class="subTask" style="margin-left:50px;" id="${val}">
    <h5><button type="button" onclick="removesub(${val})" class="removeTask btn-danger btn">-</button> Sub Task</h5>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Task Name</span>
        </div>
        <input name="STname[]" type="Text" class="form-control" placeholder="Task Name">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Start Date</span>
        </div>
        <input "STsd[]" type="Date" class="form-control substartDate" placeholder="Hours">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text"  id="basic-addon1">Working Days</span>
        </div>
        <input name="SThrs[]"  type="number" class="form-control subworkingHours" placeholder="Days">
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
        <span class="input-group-text" id="basic-addon1">Due Date</span>
        </div>
        <input name="STdd[]" type="Date" class="form-control subdueDate" placeholder="Hours">
    </div>
    
</div>`
    );
})
function addDays(date, days) {
    sad = new Date(date);
    sad.setDate(sad.getDate() + parseInt(days));
    var dd = ""+sad.getDate();
    var mm = ""+(sad.getMonth()+1);
    if (dd.length<2)dd = "0"+dd;
    if (mm.length<2)mm = "0"+mm;
    var yyyy = sad.getFullYear();
    return (yyyy+'-'+mm+'-'+dd);
}
function subDays(date, days) {
    sad = new Date(date);
    sad.setDate(sad.getDate() - parseInt(days));
    var dd = ""+sad.getDate();
    var mm = ""+(sad.getMonth()+1);
    if (dd.length<2)dd = "0"+dd;
    if (mm.length<2)mm = "0"+mm;
    var yyyy = sad.getFullYear();
    return (yyyy+'-'+mm+'-'+dd);
}
