
<link rel="stylesheet" href="https://unpkg.com/tailwindcss@^1.0/dist/tailwind.min.css">

<style>
	[x-cloak] {
		display: none;
	}

	[type="checkbox"] {
		box-sizing: border-box;
		padding: 0;
	}
	.supp {
		overflow: visible;
		margin: 1em;
	}
	.supps{
		    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
	}
	.form-checkbox,
	.form-radio {
		-webkit-appearance: none;
		-moz-appearance: none;
		appearance: none;
		-webkit-print-color-adjust: exact;
		color-adjust: exact;
		display: inline-block;
		vertical-align: middle;
		background-origin: border-box;
		-webkit-user-select: none;
		-moz-user-select: none;
		-ms-user-select: none;
		user-select: none;
		flex-shrink: 0;
		color: currentColor;
		background-color: #fff;
		border-color: #e2e8f0;
		border-width: 1px;
		height: 1.4em;
		width: 1.4em;
	}

	.form-checkbox {
		border-radius: 0.25rem;
	}

	.form-radio {
		border-radius: 50%;
	}

	.form-checkbox:checked {
		background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3cpath d='M5.707 7.293a1 1 0 0 0-1.414 1.414l2 2a1 1 0 0 0 1.414 0l4-4a1 1 0 0 0-1.414-1.414L7 8.586 5.707 7.293z'/%3e%3c/svg%3e");
		border-color: transparent;
		background-color: currentColor;
		background-size: 100% 100%;
		background-position: center;
		background-repeat: no-repeat;
	}

	.form-radio:checked {
		background-image: url("data:image/svg+xml,%3csvg viewBox='0 0 16 16' fill='white' xmlns='http://www.w3.org/2000/svg'%3e%3ccircle cx='8' cy='8' r='3'/%3e%3c/svg%3e");
		border-color: transparent;
		background-color: currentColor;
		background-size: 100% 100%;
		background-position: center;
		background-repeat: no-repeat;
	}
</style>

<section id="menu" class="menu section-bg">
	<div class="container" data-aos="fade-up">

		<div class="section-title">
			<h2>Bowl Composé</h2>
			<p>Compose your own bowl</p>
		</div>



		<div class="row menu-container" data-aos="fade-up" data-aos-delay="200" x-data="bowlcompose()">

			<div class="max-w-3xl mx-auto px-4 py-10">

				<div x-show.transition="step === 'complete'">
					<div class="bg-white rounded-lg p-10 flex items-center shadow justify-between">
						<div>
							<svg class="mb-4 h-20 w-20 text-green-500 mx-auto" viewBox="0 0 20 20" fill="currentColor">  <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg>

							<h2 class="text-2xl mb-4 text-gray-800 text-center font-bold">Registration Success</h2>

							<div class="text-gray-600 mb-8">
								Thank you. We have sent you an email to demo@demo.test. Please click the link in the message to activate your account.
							</div>

							<button
							@click="step = 1"
							class="w-40 block mx-auto focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-gray-600 bg-white hover:bg-gray-100 font-medium border" 
							>Back to home</button>
						</div>
					</div>
				</div>

				<div x-show.transition="step != 'complete'">	
					<!-- Top Navigation -->
					<div class="border-b-2 py-4">
						<div class="uppercase tracking-wide text-xs font-bold text-gray-500 mb-1 leading-tight" x-text="`Step: ${step} of 6`"></div>
						<div class="flex flex-col md:flex-row md:items-center md:justify-between">
							<div class="flex-1">
								<div x-show="step === 1">
									<div class="text-lg font-bold text-gray-700 leading-tight">Base</div>
								</div>

								<div x-show="step === 2">
									<div class="text-lg font-bold text-gray-700 leading-tight">Garnitures</div>
								</div>

								<div x-show="step === 3">
									<div class="text-lg font-bold text-gray-700 leading-tight">Protéine</div>
								</div>
								<div x-show="step === 4">
									<div class="text-lg font-bold text-gray-700 leading-tight">Toppings</div>
								</div>
								<div x-show="step === 5">
									<div class="text-lg font-bold text-gray-700 leading-tight">Sauce</div>
								</div>
								<div x-show="step === 6">
									<div class="text-lg font-bold text-gray-700 leading-tight">Supplement</div>
								</div>
							</div>

							<div class="flex items-center md:w-64">
								<div class="w-full bg-white rounded-full mr-2">
									<div class="rounded-full bg-green-500 text-xs leading-none h-2 text-center text-white" :style="'width: '+ parseInt(step / 6 * 100) +'%'"></div>
								</div>
								<div class="text-xs w-10 text-gray-600" x-text="parseInt(step / 6 * 100) +'%'"></div>
							</div>
						</div>
					</div>
					<!-- /Top Navigation -->

					<!-- Step Content -->
					<div class="py-10">	
						<div x-show.transition.in="step === 1">
							<div class="mb-5">
								<label for="email" class="font-bold mb-1 text-gray-700 block">Base</label>
								<div class="flex">
									<template x-for="(item,index) in base">
										<div>
											<label
											class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
											<div class="text-teal-600 mr-3">
												<input type="radio"  :value="item.name"  x-model="selected.base" class="form-radio focus:outline-none focus:shadow-outline" />
											</div>
											<div x-text="item.name" class="select-none text-gray-700"  ></div>
										</label>





									</div>
								</template>
							</div>
							
						</div>

					</div>
					
					<div x-show.transition.in="step === 2">
						<div class="mb-5">
							<label for="email" class="font-bold mb-1 text-gray-700 block">Garnitures</label>
							
							<div class="flex">
								<template x-for="(item,index) in garnitures">
									<div>
										<label
										class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
										<div class="text-teal-600 mr-3">
											<input type="checkbox"  :value="item.name"  x-model="selected.garniture" class="form-checkbox focus:outline-none focus:shadow-outline" />
										</div>
										<div x-text="item.name" class="select-none text-gray-700"  ></div>
									</label>





								</div>
							</template>






						</div>

					</div>

				</div>

				<div x-show.transition.in="step === 3">
					<div class="mb-5">
						<label for="email" class="font-bold mb-1 text-gray-700 block">Protéine</label>

						<div class="flex">
							<template x-for="(item,index) in proteine">
								<div>
									<label
									class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
									<div class="text-teal-600 mr-3">
										<input type="radio"  :value="item.name"  x-model="selected.proteine" class="form-radio focus:outline-none focus:shadow-outline" />
									</div>
									<div x-text="item.name" class="select-none text-gray-700"  ></div>
								</label>

								

								

							</div>
						</template>






					</div>

				</div>

			</div>

			<div x-show.transition.in="step === 4">
				<div class="mb-5">
					<label for="email" class="font-bold mb-1 text-gray-700 block">Toppings</label>

					<div class="flex">
						<template x-for="(item,index) in topping">
							<div>
								<label
								class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
								<div class="text-teal-600 mr-3">
									<input type="checkbox"  :value="item.name"  x-model="selected.topping" class="form-checkbox focus:outline-none focus:shadow-outline" />
								</div>
								<div x-text="item.name" class="select-none text-gray-700"  ></div>
							</label>





						</div>
					</template>






				</div>

			</div>

		</div>



		<div x-show.transition.in="step === 5">
			<div class="mb-5">
				<label for="email" class="font-bold mb-1 text-gray-700 block">Sauce</label>

				<div class="flex">
					<template x-for="(item,index) in sauce">
						<div>
							<label
							class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">
							<div class="text-teal-600 mr-3">
								<input type="radio"  :value="item.name"  x-model="selected.sauce" class="form-radio focus:outline-none focus:shadow-outline" />
							</div>
							<div x-text="item.name" class="select-none text-gray-700"  ></div>
						</label>





					</div>
				</template>






			</div>

		</div>

	</div>

	<div x-show.transition.in="step === 6">
		<div class="mb-5">
			<label for="email" class="font-bold mb-1 text-gray-700 block">Supplement</label>
			
			<div  class="supps">
				<template x-for="(item,index) in supp">
				<label
				class="flex supp justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4">

				<div class="text-teal-600 mr-3">
					<input type="checkbox" x-model="selected_supp"  :value="item.name"  class="form-check focus:outline-none focus:shadow-outline" />
				</div>
				<div class="select-none text-gray-700"  x-text="item.name"></div>
				<div class="select-none text-gray-700"  x-text="' ('+item.price+'€)'"></div>
			</label>
			</template>

		</div>
		

	</div>

</div>
</div>
<!-- / Step Content -->
</div>
</div>

<!-- Bottom Navigation -->	
<div class="fixed bottom-0 left-0 right-0 py-5" x-show="step != 'complete'">
	<div class="max-w-3xl mx-auto px-4">
		<div class="flex justify-between">
			<div class="w-1/2">
				<button
				style = "background-color:#cda45e !important;"
				x-show="step > 1"
				@click="step--"
				class="w-32 focus:outline-none py-2 px-5 rounded-lg shadow-sm text-center text-white  hover:bg-gray-100 font-medium border" 
				>Previous</button>
			</div>

			<div class="w-1/2 text-right">
				<button
				style = "background-color:#cda45e !important;"
				x-show="step < 6"
				@click="checkSelection(step)"
				class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
				>Next</button>

				<button
				@click="addComposeToCart(selected,selected_supp,supp)"
				style = "background-color:#cda45e !important;"
				x-show="step === 6" 
				class="w-32 focus:outline-none border border-transparent py-2 px-5 rounded-lg shadow-sm text-center text-white bg-blue-500 hover:bg-blue-600 font-medium" 
				>Complete</button>
			</div>
		</div>
	</div>
</div>
<!-- / Bottom Navigation https://placehold.co/300x300/e2e8f0/cccccc -->	


</div>

</div>

</section><!-- End Menu Section -->
