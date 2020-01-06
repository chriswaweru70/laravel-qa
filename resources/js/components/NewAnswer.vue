<template>
	<div class="row mt-4">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">
						<h2>Your Answer</h2>
					</div>
					<hr />
					<form @submit.prevent="create">
						<div class="form-group">
							<m-editor :body="body" name="new-answer">
								<textarea class="form-control" rows="7" name="body" v-model="body" required></textarea>
							</m-editor>
						</div>
						<div class="form-group">
							<button type="submit" :disabled="isInvalid" class="btn btn-lg btn-outline-primary">Submit</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
import MEditor from './MEditor.vue'

export default {
	props: ['questionId'],

	components: { MEditor },

	data() {
		return {
			body: ''
		}
	},
	computed: {
		isInvalid() {
			return !this.signedIn || this.body.length < 10
		}
	},
	methods: {
		create() {
			axios
				.post(`/questions/${this.questionId}/answers`, {
					body: this.body
				})
				.then(({ data }) => {
					this.$toast.success(data.message, 'Success')
					this.body = ''
					this.$emit('created', data.answer)
					console.log(data)
				})
				.catch(error => {
					this.$toast.error(error.response.data.message, 'Error')
					console.log(error)
				})
		}
	}
}
</script>