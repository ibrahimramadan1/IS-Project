var deliverables = 0;
var Workers = 2;
function addDeliverable() {
    $('.deliverablesDetails').append(
        `<div class="input-group mb-3" id="${deliverables}">
        <div class="input-group-prepend">
          <span class="input-group-text" id="basic-addon1">Deliverable</span>
          <button onclick="remove(${deliverables++})" class="btn s btn-danger">-</button>
        </div>
        <input name="deliv[]" type="text" class="form-control" placeholder="Deliverable Name">
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
            <input name="Wname[]" type="text" class="form-control" placeholder="Worker Name">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Worker Title</span>
            </div>
            <input name="Wtitle[]" type="text" class="form-control" placeholder="Worker title">
        </div>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
            <span class="input-group-text" id="basic-addon1">Hours/Day</span>
            </div>
            <input name="Whrs[]" type="number" class="form-control" placeholder="Hours each day">
        </div>
    </div>`
    );
}
function remove(id) {
    $('#'+id).remove();
}
