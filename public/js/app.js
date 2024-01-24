//Total Cost
let totalCost = 0;

function updateTotalCost(){ 
   const totalCostDisplay = document.getElementById('totalCost');
   totalCostDisplay.innerHTML = totalCost.toFixed(2);
}  

function addItemToCart(total){
   totalCost += parseFloat(total);
   updateTotalCost()
}
// Image Modal

function imageinModal(imageSrc){
   const modalImage = document.getElementById('modalImage').src = imageSrc
}

// Order Modal

function orderModal(button){
   const orderModal = document.getElementById('orderModal');
   const productId = orderModal.querySelector('#productId');
   const productName = orderModal.querySelector('#productName');
   const productImage = orderModal.querySelector('#productImage');
   const quantity = orderModal.querySelector('#quantity');
   const mobileNumber = orderModal.querySelector('#mobileNumber');
   totalPrice = orderModal.querySelector('#totalPrice');

   // dataset
   const price = parseFloat(button.dataset.price);
   const unit = button.dataset.unit;
   productId.value = button.dataset.id;
   productName.value = button.dataset.name;
   productImage.src = button.dataset.image;
   totalPrice.value = price.toFixed(2);

   quantity.value = '1'// Default;
   quantity.min = unit === 'kg' ? '0.01' : '1' //min value based
   quantity.step = unit === 'kg' ? '0.01' : '1' //min value based
   // totalPrice 
   quantity.oninput = () => {
      totalPrice.value = (parseFloat(quantity.value) * price).toFixed(2)
   }
}

//Form 

const orderForm = document.getElementById('orderForm')

orderForm.addEventListener('submit', async function(e){

   try{

      let formData = new FormData(this)

      const response = await fetch('submit_order.php', {
         method: 'POST',
         body: formData
      });

      if(!response.ok){
         throw new Error("Network was not ok")
      }


      const responseData = await response.json();

      if(response.sucess){
         alert('Order submitted successfully');
         window.location.href = responseData.redirect;
      }else{
         alert('There was an error submitting your order' + responseData.error)
      }

   }catch(error){
      alert("There was an error submitting your order: " + error.message);
   }

   e.preventDefault()
}) 