<template>
	<section>
		<div>
			EDITAR RENTAS
		</div>
		<section>
			<div>
				<label>Fecha de inicio</label>
                <input type="datetime-local" v-model="rental.start_date"> 

                <label>Fecha final</label>
                <input type="datetime-local" v-model="rental.end_date"> 

                <label>Total</label>
                <input type="text" v-model="rental.total"> 

                <label>Usuario</label>
                <input type="text" v-model="rental.user_id"> 

                 <label>Estado</label>
                <input type="text" v-model="rental.status_id">
			</div>
			<div>
				<button @click="edit">Editar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "rental-edit-component",
		data() {
			return {				
				rental 		:{
                    start_date: 	'',
                    end_date: 	'',
                    total: 	'',
                    user_id: 	'',		
                    status_id: ''			
				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			rentalId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'RentalList')
			},	
			getRentalById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/rentals/' + this.rentalId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.rental = response.data.data.rental
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			},
			edit: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/rentals/' + this.rentalId

				let data = {
                    tart_date	: this.rental. start_date,
                    end_date	: this.rental.end_date,
                    total	: this.rental.total,
                    user_id	: this.rental.user_id,
                    status_id : this.rental.status_id
				}

				axios
					.put(url, data, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {
							alert(response.data.message)
							that.close()
						} else {
							alert(response.data.message)
						}

					})
					.catch((error) => {						
						alert(error.data.message)
					})
			}
		},
		mounted() {
			this.getRentalById()
		}
	}
</script>
