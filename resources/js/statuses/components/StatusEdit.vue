<template>
	<section>
		<div>
			EDITAR CATEGORÍA
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="status.name">

                <label>Tipo Estatus</label>
				<input type="text" v-model="status.type_status_id">
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
		name: "status-edit-component",
		data() {
			return {				
				status 		:{
                    name: 	'',		
                    type_status_id: ''			
				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			statusId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'StatusList')
			},	
			getStatusById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/statuses/' + this.statusId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.status = response.data.data.status
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

				let url = this.base_url + '/api/statuses/' + this.statusId

				let data = {
                    name	: this.status.name,
                    type_status_id : this.status.type_status_id
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
			this.getStatusById()
		}
	}
</script>
