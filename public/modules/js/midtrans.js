const buy = (e, order) => {
  e.innerHTML = "Loading..."
  e.disabled = true
  let transactionId = []
  let transaction = document.querySelectorAll(`input[name='transaction[]'][data-order='${order}']`)
  let status = document.querySelectorAll(`span[data-order='${order}']`)
  transaction.forEach(t => transactionId = [...transactionId, t.value])
  
  $.ajax({
    type: "POST",
    url: "/profile/transaction/buy",
    data: {
      transaction: JSON.stringify(transactionId)
    },
    dataType: "json",
    success: function(response) {
      e.innerHTML = "BUY NOW"
      e.disabled = false
      if(response.success) {
        snap.pay(response.snapToken, {
          onSuccess: function(result) {
            $.ajax({
              type: "POST",
              url: "/profile/transaction/continuepay",
              data: {
                transaction: JSON.stringify(transactionId),
                token: response.snapToken,
                payment_deadline: result.transaction_time,
                order_id: result.order_id,
              },
              dataType: "json",
              success: function(res) {
                if(res.success) {
                  e.remove()
                  status.forEach(stat => {
                    stat.innerHTML = "pending"
                    stat.classList.remove("badge-warning")
                    stat.classList.add("badge-secondary")
                  })
                  let spanDeadline = document.querySelectorAll(`.deadlinepay[data-order='${order}']`)
                  let btn = document.querySelector(`.continuepay-btn[data-order='${order}']`)
                  btn.dataset.token = response.snapToken
                  btn.dataset.orderid = result.order_id
                  btn.removeAttribute("hidden")
                  spanDeadline.forEach(sd => sd.innerHTML = result.transaction_time)
                }
              }
            })
            
            Swal.fire(
              'Payment Success',
              'Your payment has been successfuly, please refresh this page.',
              'success'
            )
          },
          onPending: function(result) {
            $.ajax({
              type: "POST",
              url: "/profile/transaction/continuepay",
              data: {
                transaction: JSON.stringify(transactionId),
                token: response.snapToken,
                payment_deadline: result.transaction_time,
                order_id: result.order_id,
              },
              dataType: "json",
              success: function(res) {
                if(res.success) {
                  e.remove()
                  status.forEach(stat => {
                    stat.innerHTML = "pending"
                    stat.classList.remove("badge-warning")
                    stat.classList.add("badge-secondary")
                  })
                  let spanDeadline = document.querySelectorAll(`.deadlinepay[data-order='${order}']`)
                  let btn = document.querySelector(`.continuepay-btn[data-order='${order}']`)
                  btn.dataset.token = response.snapToken
                  btn.dataset.orderid = result.order_id
                  btn.removeAttribute("hidden")
                  spanDeadline.forEach(sd => sd.innerHTML = result.transaction_time)
                }
              }
            })
          },
          onError: function(result) {
            Swal.fire(
              'Payment Error',
              result.status_message,
              'error'
            )
          }
        })
      } else {
        Swal.fire(
          'Payment Failed',
          'We cannot to continue your payment because the product you selected has out of stock.',
          'error'
        )
        e.innerHTML = "BUY NOW"
        e.disabled = false
      }
    }
  })
}

const continuePay = (e) => {
  let order = e.dataset.order
  let token = e.dataset.token
  let order_id = e.dataset.order_id

  snap.pay(token, {
    onSuccess: function(result) {
      Swal.fire(
        'Payment Success',
        'Your payment has been successfuly, please refresh this page.',
        'success'
      )
    },
    onPending: function(result) {
      console.log(result.order_id)
    },
    onError: function(result) {
      Swal.fire(
        'Payment Error',
        result.status_message,
        'error'
      )
    }
  })
}