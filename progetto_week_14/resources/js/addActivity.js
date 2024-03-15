document.getElementById("addActivity").addEventListener("click", function () {
    var activitiesDiv = document.getElementById("activities");
    var newActivityDiv = document.createElement("div");
    newActivityDiv.classList.add("activity");
    newActivityDiv.innerHTML = `
    
    <div class="flex mt-3">
    <input type="text" id="activity_name" name="activity_name[]"
        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
        placeholder="activity name..." />
        <button type="button" class="removeActivity text-white bg-red-600 hover:bg-red-800 focus:outline-none focus:ring-4 focus:ring-red-300 font-medium rounded-full text-sm px-5 py-2.5 text-center me-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Remove</button>    </div>
        `;
    activitiesDiv.appendChild(newActivityDiv);
});

document.getElementById("activities").addEventListener("click", function (e) {
    if (e.target.classList.contains("removeActivity")) {
        e.target.parentElement.parentElement.remove();
    }
});
