const taskInput = document.getElementById('taskInput');
const addTaskBtn = document.getElementById('addTaskBtn');
const taskList = document.getElementById('taskList');

// Function to add a new task
addTaskBtn.addEventListener('click', () => {
    const taskValue = taskInput.value.trim();
    if (taskValue) {
        addTask(taskValue);
        taskInput.value = '';
    }
});

// Function to add a task to the list and backend
function addTask(task) {
    // Integrate with your backend API to create a new task
    fetch('YOUR_API_URL/tasks', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ task })
    })
    .then(response => response.json())
    .then(data => {
        const li = document.createElement('li');
        li.textContent = task;

        const deleteBtn = document.createElement('button');
        deleteBtn.textContent = 'Delete';
        deleteBtn.classList.add('delete');
        deleteBtn.addEventListener('click', () => deleteTask(data.id, li));

        li.appendChild(deleteBtn);
        taskList.appendChild(li);
    })
    .catch(error => console.error('Error:', error));
}

// Function to delete a task
function deleteTask(taskId, li) {
    // Integrate with your backend API to delete the task
    fetch(`YOUR_API_URL/tasks/${taskId}`, {
        method: 'DELETE',
    })
    .then(response => {
        if (response.ok) {
            taskList.removeChild(li);
        } else {
            console.error('Failed to delete task');
        }
    })
    .catch(error => console.error('Error:', error));
}



// //integrating
// const taskInput = document.getElementById('taskInput');
// const addTaskBtn = document.getElementById('addTaskBtn');
// const taskList = document.getElementById('taskList');

// // Fetch tasks from the backend on page load
// document.addEventListener('DOMContentLoaded', fetchTasks);

// function fetchTasks() {
//     fetch('http://localhost/todo-api/get_tasks.php')
//         .then(response => response.json())
//         .then(data => {
//             data.forEach(task => {
//                 addTaskToList(task.id, task.task);
//             });
//         })
//         .catch(error => console.error('Error fetching tasks:', error));
// }

// // Function to add a new task
// addTaskBtn.addEventListener('click', () => {
//     const taskValue = taskInput.value.trim();
//     if (taskValue) {
//         addTask(taskValue);
//         taskInput.value = '';
//     }
// });

// // Function to add a task to the list and backend
// function addTask(task) {
//     fetch('http://localhost/todo-api/create_task.php', {
//         method: 'POST',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ task })
//     })
//     .then(response => response.json())
//     .then(data => {
//         addTaskToList(data.id, data.task);
//     })
//     .catch(error => console.error('Error adding task:', error));
// }

// // Helper function to add task to the UI
// function addTaskToList(taskId, task) {
//     const li = document.createElement('li');
//     li.textContent = task;

//     const deleteBtn = document.createElement('button');
//     deleteBtn.textContent = 'Delete';
//     deleteBtn.classList.add('delete');
//     deleteBtn.addEventListener('click', () => deleteTask(taskId, li));

//     li.appendChild(deleteBtn);
//     taskList.appendChild(li);
// }

// // Function to delete a task
// function deleteTask(taskId, li) {
//     fetch('http://localhost/todo-api/delete_task.php', {
//         method: 'DELETE',
//         headers: {
//             'Content-Type': 'application/json',
//         },
//         body: JSON.stringify({ id: taskId })
//     })
//     .then(response => {
//         if (response.ok) {
//             taskList.removeChild(li);
//         } else {
//             console.error('Failed to delete task');
//         }
//     })
//     .catch(error => console.error('Error deleting task:', error));
// }