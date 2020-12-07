<template>
	<section>
		<div>
			NUEVA RENTA
		</div>
		<section>
			<div>
				<label>Fecha de inicio</label>
                <input type="datetime-local" v-model="start_date"> 

                <label>Fecha final</label>
                <input type="datetime-local" v-model="end_date"> 

                <label>Total</label>
                <input type="text" v-model="total"> 

                <label>Usuario</label>
                <input type="text" v-model="user_id"> 

			</div>
			<div>
				<button @click="insert">Guardar</button>
				<button @click="close">Cancelar</button>
			</div>
		</section>			
	</section>
</template>

<script>
	export default {
		name: "rental-insert-component",
		data() {
			return {
                start_date			:'',
                end_date            :'',
                total               :'',
                user_id             :''
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			}
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'RentalList')
			},		
			insert: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/rentals'

				let data = {
                     start_date	:this. start_date,
                     end_date   :this. end_date,
                     total      :this. total,
                     user_id    :this. user_id
				}

				axios
					.post(url, data, headers)
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
		}
	}
</script>
