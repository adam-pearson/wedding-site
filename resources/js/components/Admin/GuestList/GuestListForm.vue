<template>
    <!-- eslint-disable max-len -->

    <form class="px-4 sm:px-6 lg:px-8">
        <div class="space-y-12">
            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Guest Information
                </h2>

                <div
                    class="mt-10 grid grid-cols-1 gap-x-6 gap-y-8 sm:grid-cols-6"
                >
                    <div class="sm:col-span-3">
                        <label
                            for="first-name"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Name</label
                        >
                        <div class="mt-2">
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Email address</label
                        >
                        <div class="mt-2">
                            <input
                                id="email"
                                name="email"
                                type="email"
                                autocomplete="email"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div class="sm:col-span-3">
                        <label
                            for="email"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Phone</label
                        >
                        <div class="mt-2">
                            <input
                                id="phone"
                                name="phone"
                                type="tel"
                                autocomplete="tel"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>

                    <div class="col-span-full">
                        <label
                            for="address"
                            class="block text-sm font-medium leading-6 text-gray-900"
                            >Address</label
                        >
                        <div class="mt-2">
                            <input
                                type="text"
                                name="address"
                                id="address"
                                autocomplete="address"
                                class="block w-full rounded-md border-0 py-1.5 text-gray-900 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-indigo-600 sm:text-sm sm:leading-6"
                            />
                        </div>
                    </div>
                </div>
            </div>

            <div class="border-b border-gray-900/10 pb-12">
                <h2 class="text-base font-semibold leading-7 text-gray-900">
                    Notifications
                </h2>
                <p class="mt-1 text-sm leading-6 text-gray-600">
                    We'll always let you know about important changes, but you
                    pick what else you want to hear about.
                </p>

                <div class="mt-10 space-y-10">
                    <fieldset>
                        <legend
                            class="text-sm font-semibold leading-6 text-gray-900"
                        >
                            By Email
                        </legend>
                        <div class="mt-6 space-y-6">
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input
                                        id="comments"
                                        name="comments"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                    />
                                </div>
                                <div class="text-sm leading-6">
                                    <label
                                        for="comments"
                                        class="font-medium text-gray-900"
                                        >Comments</label
                                    >
                                    <p class="text-gray-500">
                                        Get notified when someones posts a
                                        comment on a posting.
                                    </p>
                                </div>
                            </div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input
                                        id="candidates"
                                        name="candidates"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                    />
                                </div>
                                <div class="text-sm leading-6">
                                    <label
                                        for="candidates"
                                        class="font-medium text-gray-900"
                                        >Candidates</label
                                    >
                                    <p class="text-gray-500">
                                        Get notified when a candidate applies
                                        for a job.
                                    </p>
                                </div>
                            </div>
                            <div class="relative flex gap-x-3">
                                <div class="flex h-6 items-center">
                                    <input
                                        id="offers"
                                        name="offers"
                                        type="checkbox"
                                        class="h-4 w-4 rounded border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                    />
                                </div>
                                <div class="text-sm leading-6">
                                    <label
                                        for="offers"
                                        class="font-medium text-gray-900"
                                        >Offers</label
                                    >
                                    <p class="text-gray-500">
                                        Get notified when a candidate accepts or
                                        rejects an offer.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </fieldset>
                    <fieldset>
                        <legend
                            class="text-sm font-semibold leading-6 text-gray-900"
                        >
                            Push Notifications
                        </legend>
                        <p class="mt-1 text-sm leading-6 text-gray-600">
                            These are delivered via SMS to your mobile phone.
                        </p>
                        <div class="mt-6 space-y-6">
                            <div class="flex items-center gap-x-3">
                                <input
                                    id="push-everything"
                                    name="push-notifications"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                />
                                <label
                                    for="push-everything"
                                    class="block text-sm font-medium leading-6 text-gray-900"
                                    >Everything</label
                                >
                            </div>
                            <div class="flex items-center gap-x-3">
                                <input
                                    id="push-email"
                                    name="push-notifications"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                />
                                <label
                                    for="push-email"
                                    class="block text-sm font-medium leading-6 text-gray-900"
                                    >Same as email</label
                                >
                            </div>
                            <div class="flex items-center gap-x-3">
                                <input
                                    id="push-nothing"
                                    name="push-notifications"
                                    type="radio"
                                    class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600"
                                />
                                <label
                                    for="push-nothing"
                                    class="block text-sm font-medium leading-6 text-gray-900"
                                    >No push notifications</label
                                >
                            </div>
                        </div>
                    </fieldset>
                </div>
            </div>
        </div>

        <div class="mt-6 flex items-center justify-end gap-x-6">
            <button
                type="button"
                class="text-sm font-semibold leading-6 text-gray-900"
            >
                Cancel
            </button>
            <button
                type="submit"
                class="rounded-md bg-indigo-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-indigo-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-indigo-600"
            >
                Save
            </button>
        </div>
    </form>
    <!-- eslint-enable max-len -->
</template>
