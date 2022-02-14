<div>
	<span
		wire:click="confirmLogout"
	    class="no-underline hover:underline text-blue-600 text-sm  md:text-md hover:font-semibold p-3 cursor-pointer">
	    
	    Logout
	</span>
</div>

<!-- Scripts -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    window.addEventListener('admin-logout', event => {

        swal({
          title: event.detail.message,
          text: event.detail.text,
          icon: event.detail.type,
          buttons:true,
          dangerMode : true
        })
        	.then((willDelete) => {
        		if(willDelete){
        			window.livewire.emit('sessionInvalidate');
        		}
        	});

    });
</script>



