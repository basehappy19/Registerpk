function confirmForm(planValue) {
    const randomCode = Math.floor(100000 + Math.random() * 900000);
    Swal.fire({
        title: 'ยืนยันการสมัครเรียน',
        text: `กรุณาพิมพ์เลข ${randomCode} เพื่อยืนยันการสมัครแผนการเรียน`,
        input: 'text',
        inputPlaceholder: `${randomCode}`,
        showCancelButton: true,
        confirmButtonColor: '#51e290',
        cancelButtonColor: '#ff508d',
        confirmButtonText: 'ยืนยัน',
        cancelButtonText: 'ยกเลิก',
        preConfirm: (inputCode) => {
            if (!inputCode || isNaN(inputCode) || inputCode != randomCode) {
                Swal.showValidationMessage('คุณใส่รหัสยืนยันผิดโปรดลองใหม่อีกครั้ง');
            } else {
                Swal.fire({
                    title: "สมัครเรียนเรียบร้อย",
                    icon: "success",
                    confirmButtonColor: '#51e290',
                    confirmButtonText: 'ตกลง'
                }).then(() => {
                    var form = document.getElementById("confirmationForm");
                    var planInput = document.createElement("input");
                    planInput.type = "hidden";
                    planInput.name = "plan";
                    planInput.value = planValue;
                    form.appendChild(planInput);
                    form.submit();
                    
                });      
            }
        },
        allowOutsideClick: () => !Swal.isLoading() 
    });
}
