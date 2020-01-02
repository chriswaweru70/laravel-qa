<template>
	<div class="row mt-4" v-cloak v-if="count">
		<div class="col-md-12">
			<div class="card">
				<div class="card-body">
					<div class="card-title">
						<h2>{{ title }}</h2>
					</div>
					<hr />
					<answer v-for="answer in answers" :answer="answer" :key="answer.id"></answer>
					<div class="text-center mt-3" v-if="nextUrl">
						<button @click.prevent="fetch(nextUrl)" class="btn btn-outline-secondary">Load More Answers</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
import Answer from './Answer.vue'
export default {
	props: ['question'],
	data() {
		return {
			questionId: this.question.id,
			count: this.question.answers_count,
			answers: [],
			nextUrl: null
		}
	},
	created() {
		this.fetch(`/questions/${this.questionId}/answers`)
	},
	methods: {
		// next() {
		// 	if (!this.signedIn) {
		// 		this.$toast.warning(
		// 			`Please login to view all the answers 🇪️🇷️`,
		// 			'Warning',
		// 			{
		// 				timeout: 3000,
		// 				position: 'center'
		// 			}
		// 		)
		// 	}
		// },
		fetch(endpoint) {
			if (!this.signedIn) {
				axios.get(endpoint).then(({ data }) => {
					this.nextUrl = null
				})
				this.$toast.warning(
					`Please login to view all the answers 🇪️🇷️`,
					'Warning',
					{
						timeout: 3000,
						position: 'center'
					}
				)
			}
			axios.get(endpoint).then(({ data }) => {
				this.answers.push(...data.data)
				this.nextUrl = data.next_page_url
			})
		}
	},
	computed: {
		title() {
			return this.count + ' ' + (this.count > 1 ? 'Answers' : 'Answer')
		}
	},
	components: {
		Answer
	}
}
</script>