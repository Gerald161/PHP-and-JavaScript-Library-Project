var form = document.querySelector('#postData');

form.addEventListener('submit', postData);

const urlParams = new URLSearchParams(window.location.search);

const myParam = urlParams.get('id');

var all_comments = document.querySelector('.all_comments');

 function postData(event){
            event.preventDefault();

            const formData = new FormData(form);

            // console.log(formData.get('title'));

            fetch(`log.php?id=${myParam}`, {
                method: 'POST',
                body:formData
            }).then((res) => res.json())
            .then((data) => {               
                   console.log(data);
                   all_comments.innerHTML += 
                    `<div class="commentary">
                        <div class="profilee">
                               <a href=timeline.php?id=${data.userid}><img src=imagee.php?id=${data.userid}></a>        
                        </div>
                        <div class="two">
                            <p style="text-transform: capitalize; color: #fff">${data.username}</p>
                            <p class="cmmt">${data.comment}</p>
                        </div>
                    
                    </div>`;
                    ;
                    form.reset();
            })
            .catch((err)=>console.log(err))
}

function getData(event){
            fetch(`log.php?id=${myParam}`).then((res) => res.json())
            .then((data) => {
                console.log(data)
                data.forEach((data)=>{
                    all_comments.innerHTML += 
                    `<div class="commentary">
                        <div class="profilee">
                               <a href=timeline.php?id=${data.userid}><img src=imagee.php?id=${data.userid}></a>        
                        </div>
                        <div class="two">
                            <p style="text-transform: capitalize; color: #fff">${data.username}</p>
                            <p class="cmmt">${window.atob(data.comment)}</p>
                        </div>
                    
                    </div>`;
                    ;
                })
            })
            .catch((err)=>console.log(err))
}

getData();