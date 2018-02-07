/**
 * Сохранение информации по задаче
 * @param id
 */
function setTask() {
    var data = {
        task_id: $('#task_id').val(),
        task_name: $('#task_name').val(),
        task_text: $('#task_text').val(),
        task_deadline: $('#task_deadline').val(),
        task_status: $('#task_status').val(),
        // user_id:,

    }
    $.ajax({
        type: "POST",
        url: '/task/set-task',
        data: data,
        error: function (data) {
            alert("Ошибка при сохранении информации по задаче setTask()");
        },
        success:function (data) {
            updateTasksList();
            $('#modal').modal('hide');
            clearModal();
        }
    });
}

/**
 * Редактирование задачи
 * @param id
 */
function editTask(id)
{
    $.ajax({
        type: "POST",
        url: '/task/edit-task',
        data: {id:id},
        error: function (data) {
            alert("Ошибка при получении информации о задаче editTask()");
        },
        success: function (data) {
            if(data.message) {
                $('#alert').text(data.message)
                $('#alert').show('slow');
                setTimeout(function() { $('#alert').hide('slow'); }, 2000);

            } else {
                $('#modal').modal('show');
                $('#task_id').val(data.id);
                $('#task_name').val(data.name);
                $('#task_text').val(data.text);
                $('#task_deadline').val(data.deadline);
                $('#task_status').val(data.status);
            }
        }
    });
}

function delTask(id) {
    $.ajax({
        type: "POST",
        url: '/task/del-task',
        data: {id:id},
        error: function (data) {
            alert("Ошибка при получении информации о задаче delTask()");
        },
        success: function (data) {
            if(data.message) {
                $('#alert').text(data.message)
                $('#alert').show('slow');
                setTimeout(function() { $('#alert').hide('slow'); }, 2000);

            } else {
                updateTasksList();
            }
        }
    });
}

/**
 * Обновление списка задач
 */
function updateTasksList() {
    $.ajax({
        type:"POST",
        url:'/task/get-all-tasks',
        error:function (data) {
            alert("Ошибка при обновлении списка задач updateTasksList()");
        },
        success:function (data) {
            $('#all-tasks-tab').empty();
            $.each(data, function(i, item){
                var stringTab = '<tr>'
                    + '<td>' + item.id + '</td>'
                    + '<td>' + item.name + '</td>'
                    + '<td>' + item.deadline + '</td>'
                    + '<td>' + item.status + '</td>'
                    + '<td class="text-center"><a href="#" onclick="editTask( ' + item.id + ')">'
                    + '<i class="fa fa-pencil" aria-hidden="true"></i>'
                    + '</a>'
                    + '<a class="col-md-offset-3" href="#" onclick="delTask( ' + item.id + ')">'
                    + '<i class="fa fa-trash-o fa-lg"></i>'
                    + '</a>'
                    + '</td>'
                    + '</tr>';

                $('#all-tasks-tab').append(stringTab);
            });
        }
    });
}

/**
 * Очистка модального окна
 */
function clearModal() {
    $('#task_id').val('');
    $('#task_name').val('');
    $('#task_text').val('');
    $('#task_deadline').val('');
    $('#task_status').val('');
}
