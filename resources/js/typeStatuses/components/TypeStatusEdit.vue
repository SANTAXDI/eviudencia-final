<template>
	<section>
		<div>
			EDITAR LISTADO DE CATEGORÍAS
		</div>
		<section>
			<div>
				<label>Nombre</label>
				<input type="text" v-model="typeStatus.name">
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
		name: "typeStatus-edit-component",
		data() {
			return {				
				typeStatus 		:{
					name: 	'',					
				}
			};
		},
		props: {
			base_url: {
				type: String,
				default: ''
			},
			typeStatusId: {
				type: Number,
				default: 0
			},
		},
		methods: {
			close: function () {
				this.$emit('onShowComponent', 'TypeStatusList')
			},	
			getTypeStatusById: function () {
				let that = this

				let headers = {
					headers: {
						"Conten-Type":  "application/json"
					}
				}

				let url = this.base_url + '/api/typeStatuses/' + this.typeStatusId

				axios
					.get(url, headers)
					.then((response) => {
						
						if(response.data.type === 'success') {							
							that.typeStatus = response.data.data.typeStatus
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

				let url = this.base_url + '/api/typeStatuses/' + this.typeStatusId

				let data = {
					name	: this.typeStatus.name
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
			this.getTypeStatusById()
		}
	}
</script>
