function openModal(userId){
    fetch('fetch/fetch_user.php',{
    method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            userId: userId,
        })
    })
    .then(response => {
        if(!response.ok){
            throw new error(response.statusText);
        } 
        return response.json();
    })
    .then(user => {
        if(!user || Object.keys(user).length === 0){
            console.error("User Not Found");
            return ;
        }

        document.getElementById("modal-name").textContent= `Name: ${user.FirstName} ${user.LastName}`;
        document.getElementById("modal-about").textContent= `About: ${user["About"]}`;
        document.getElementById("modal-email").textContent= `Email: ${user["Email"]}`;
        document.getElementById("modal-qualification").textContent= `Qualification: ${user["HighestQualification"]}`;
        document.getElementById("modal-skill").textContent= `Skill: ${user["SkillName"]}`;
        document.getElementById("modal-gender").textContent= `Gender: ${user["Gender"]}`;
        document.getElementById("modal-age").textContent= `Age: ${user["Age"]}`;
        document.getElementById("modal-location").textContent= `Location: ${user["LocationName"]}`;
        document.getElementById("modal-image").src= `data:image/png;base64,${user.image}`;
        document.getElementById("modal-resume").href= `data:application/pdf;base64,${user.resume}`;
        document.getElementById("modal-resume").download= `${user['First name']}_${user['Last name']}_Resume.pdf`;

        //Show the modal
        const modal= document.getElementById("user-modal");
        modal.classList.remove("hide");
        modal.classList.add("show");
        modal.style.display="block";


    })
    .catch((error)=>{
        console.error("Error fetching user data: "+error);
    })

}

function closeModal(){
    const modal=document.getElementById("user-modal");
    modal.classList.remove("show");
    modal.classList.add("hide");
    modal.addEventListener("animationend",()=>{
        modal.style.display="none";
    },
    {once:true}
    );
}

document.querySelector(".close-btn").onclick=closeModal;