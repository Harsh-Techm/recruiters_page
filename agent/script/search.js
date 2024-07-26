document.addEventListener("DOMContentLoaded", (event) => {
  populateFilters();
  filterResults();
});

function populateFilters() {
  fetch("fetch/fetch_filters.php")
    .then((response) => {
      if (!response.ok) {
        throw new Error("Network response was not ok " + response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      const locationFilter = document.getElementById("location-filter");
      const skillFilter = document.getElementById("skill-filter");
      const experienceFilter = document.getElementById("experience-filter");

      data.locations.forEach((location) => {
        const option = document.createElement("option");
        option.value = location;
        option.textContent = location;
        locationFilter.appendChild(option);
      });

      data.skills.forEach((skill) => {
        const option = document.createElement("option");
        option.value = skill;
        option.textContent = skill;
        skillFilter.appendChild(option);
      });

      data.experiences.forEach((experience) => {
        const option = document.createElement("option");
        option.value = experience;
        option.textContent = experience;
        experienceFilter.appendChild(option);
      });
    })
    .catch((error) => {
      console.error(
        "There has been a problem with your fetch operation:",
        error
      );
    });
}

function filterResults() {
  const searchTerm = document.getElementById("search-bar").value;
  const location = document.getElementById("location-filter").value;
  const skill = document.getElementById("skill-filter").value;
  const experience = document.getElementById("experience-filter").value;

  fetch("fetch/fetch_results.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
      searchTerm,
      location,
      skill,
      experience,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      // console.log(data)
      const resultsContainer = document.getElementById("results");

      resultsContainer.innerHTML = "";

      let tableHTML = `
      <table id="myTable">
        <thead>
           <tr>
                <th>Employee name</th>
                <th>Experience</th>
                <th>Location</th>
                <th>Skill</th>
                <th>Acted by</th>
                <th>Project</th>
                <th>Status</th>
                <th>Action</th>
                
            </tr>
        </thead>
        <tbody>`;
      data.forEach((user) => {
        tableHTML += `
            <tr id='row${user.UserId}'>
                <td>${user.FirstName} ${user.LastName}</td>
                
                <td>${user.Experience} </td>
                <td>${user.LocationName}</td>
                <td>${user.SkillName}</td>
                
                <td>${user.UserName==null?'-------':user.UserName}</td>
                <td>${user.ProjectName==null?'-------':user.ProjectName}</td>
                <td>
                    ${user.Status=='confirm'?'<img class="search_user_status confirm" src="../images/confirm.svg" />':
                    user.Status=='softlock'?'<img class="search_user_status lock" src="../images/softlock.svg" />':
                    '<img class="search_user_status unlock" src="../images/unlock.svg" />'
                    }
                </td>
                <td>
                    <button id='search-softlock-btn' class='search-softlock-btn' ${user.Status=='confirm'?'Disabled' :user.Status=='softlock'? 'Disabled':''}  data-user-email='${user.UserId}'>Softlock</button>
                    <button class='search-confirm-btn'  ${user.Status=='confirm'?'Disabled':getcookie("AgentId")!=user.AgentId?'Disabled':''} data-user-email='${user.UserId}'>Confirm</button>
                </td>
                
            </tr>`;
      });
      tableHTML += `</tbody>
                </table>`;

      resultsContainer.innerHTML = tableHTML;
    
    $("#myTable").DataTable();
      document.querySelectorAll(".search-softlock-btn").forEach((button) => {
        button.addEventListener("click", (event) => {
        //   if (confirm("Are you really want to soft lock the Employee")) {
            showSoftlockModal(event.target.dataset.userEmail);
        //   }
        //   console.log(event.target.dataset.userEmail);
        });
      });

      document.querySelectorAll(".search-confirm-btn").forEach((button) => {
        button.addEventListener("click", (event) => {
        //   if (confirm("Are you really want to confirm the Employee")) {
            showConfirmModal(event.currentTarget.dataset.userEmail);
        //   }
        //   console.log(event.currentTarget.dataset.userEmail);
        });
      });
    });
  // .catch(error => {
  //     console.error('There has been a problem with your fetch operation:', error);
  // });
}
function fetchProjectNames(){
    return fetch('fetch/fetch_get_project.php')
    .then(response=>response.json())
    .then(data=>{
        return data.projects;
    })
}
function showConfirmModal(UserId){
    const modal=document.getElementById('project-confirm-modal');
    const projectDropdown=document.getElementById('confirmprojectDropdown');
    const confirmBtn=document.getElementById('confirm-project-button');

    fetchProjectNames().then(projects=>{
        projectDropdown.innerHTML='';
        // console.log(projects);
        projects.forEach(project=>{
            const option=document.createElement("option");
            option.className='smallModalDropdownOption';
            option.value=project.ProjectId;
            option.textContent=project.ProjectName;
            
            projectDropdown.appendChild(option);
        })
        // console.log(projectDropdown);
    })
    modal.style.display="block";

    confirmBtn.onclick=()=>{
        const projectId=projectDropdown.value;
        confirmUser(UserId,projectId);
        modal.style.display="none";

    }

}
function showSoftlockModal(UserId){
    const modal=document.getElementById('project-softlock-modal');
    const projectDropdown=document.getElementById('softlockprojectDropdown');
    const softlockBtn=document.getElementById('softlock-project-button');

    fetchProjectNames().then(projects=>{
        projectDropdown.innerHTML='';
        // console.log(projects);
        projects.forEach(project=>{
            const option=document.createElement("option");
            option.className='smallModalDropdownOption';
            option.value=project.ProjectId;
            option.textContent=project.ProjectName;
            
            projectDropdown.appendChild(option);
        })
        // console.log(projectDropdown);
    })
    modal.style.display="block";

    softlockBtn.onclick=()=>{
        const projectId=projectDropdown.value;
        softlockUser(UserId,projectId);
        modal.style.display="none";

    }

}

function softlockUser(UserId,projectId) {
  const AgentId = getcookie("AgentId");
// const AgentId =2;
  fetch("fetch/fetch_save_softlock.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
        UserId: UserId,
        AgentId: AgentId,
        projectId:projectId,
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        showNotification("Successfully Softlocked");

        const userElement = document.querySelector(`tr[id="row${UserId}"]`);
        // console.log(userElement);

        //change the class and text of softlock button
        const softlockBtn = userElement.querySelector("#search-softlock-btn");
        softlockBtn.disabled=true;
        const softlockImage=userElement.querySelector(".search_user_status");
        softlockImage.src="../images/softlock.svg";


      } else {
        showNotification("Error: " + data.message, "error");
      }
    })
    .catch((error) => {
      showNotification("Error: " + error.message, "error");
    });
}

function confirmUser(UserId,projectId) {
  const AgentId = getcookie("AgentId");
// const AgentId=2;

  fetch("fetch/fetch_save_confirmation.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify({
        UserId: UserId,
        AgentId: AgentId,
        projectId:projectId
    }),
  })
    .then((response) => {
      if (!response.ok) {
        throw new error(response.statusText);
      }
      return response.json();
    })
    .then((data) => {
      if (data.status == "success") {
        showNotification("Employee Confirmed");

        const userElement = document.querySelector(`tr[id="row${UserId}"]`);
        // console.log(userElement);

        //set to disable confirm button
        const confirmBtn = userElement.querySelector(".search-confirm-btn");
        confirmBtn.disabled=true;
        const confirmImage=userElement.querySelector(".search_user_status");
        confirmImage.src="../images/confirm.svg";
        
      } else {
        showNotification("Error: " + data.message, "error");
      }
    })
    .catch((error) => {
      showNotification("Error: " + error.message, "error");
    });
}


