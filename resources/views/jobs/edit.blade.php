<x-layout>
    <x-slot name="title">
        Edit Job Listing
    </x-slot>
    <div class="bg-white mx-auto p-8 rounded-lg shadow-md w-full md:max-w-3xl">
        <h2 class="text-4xl text-center font-bold mb-4">
            Edit Job Listing
        </h2>

        <form method="POST" action="{{ route('jobs.update', $job->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Job Info
            </h2>

            <x-inputs.text id="title" name="title" label="Job Title" placeholder="Software Engineer"
                :value="old('title', $job->title)" />

            <x-text-area id="description" name="description" label="Job Description"
                placeholder="We are seeking a skilled and motivated Software Developer to join our growing development team..."
                :value="old('description', $job->description)" />

            <x-inputs.text id="salary" name="salary" label="Annual Salary" type="number" placeholder="90000"
                :value="old('salary', $job->salary)" />

            <x-inputs.text-area id="requirements" name="requirements" label="Requirements"
                placeholder="Bachelor's degree in Computer Science" :value="old('requirements', $job->requirements)" />

            <x-inputs.text-area id="benefits" name="benefits" label="Benefits"
                placeholder="Health insurance, 401k, paid time off" :value="old('benefits', $job->benefits)" />

            <x-inputs.text id="tags" name="tags" label="Tags (comma-separated)" type="text"
                placeholder="development,coding,java,python" :value="old('tags', $job->tags)" />

            <x-inputs.select id="job_type" name="job_type" label="Job Type" :options="['Full-time' => 'Full-time', 'Part-time' => 'Part-time', 'Contract' => 'Contract', 'Temporary' => 'Temporary', 'Internship' => 'Internship', 'Volunteer' => 'Volunteer', 'On-Call' => 'On-Call']"
                value="{{ old('job_type', $job->job_type) }}" />

            <x-inputs.select id="remote" name="remote" label="Remote" :options="[0 => 'No', 1 => 'Yes']"
                :value="old('remote', $job->remote)" />

            <x-inputs.text id="address" name="address" label="Address" type="text" placeholder="123 Main St"
                :value="old('address', $job->address)" />

            <x-inputs.text id="city" name="city" label="City" type="text" placeholder="Albany" :value="old('city', $job->city)" />

            <x-inputs.text id="state" name="state" label="State" type="text" placeholder="NY" :value="old('state', $job->state)" />

            <x-inputs.text id="zipcode" name="zipcode" label="ZIP Code" type="text" placeholder="12201"
                :value="old('zipcode', $job->zipcode)" />

            <h2 class="text-2xl font-bold mb-6 text-center text-gray-500">
                Company Info
            </h2>

            <x-inputs.text id="company_name" name="company_name" label="Company Name" type="text"
                :value="old('company_name', $job->company_name)" placeholder="Enter Company name" />

            <x-inputs.text-area id="company_description" name="company_description" label="Company Description"
                placeholder="Enter Company Description" :value="old('company_description', $job->company_description)" />

            <x-inputs.text id="company_website" name="company_website" label="Company Website" type="url"
                :value="old('company_website', $job->company_website)" placeholder="Enter website" />

            <x-inputs.text id="contact_phone" name="contact_phone" label="Contact
                Phone" type="text" placeholder=" Enter phone" :value="old('contact_phone', $job->contact_phone)" />

            <x-inputs.text id="contact_email" name="contact_email" label="Contact Email" type="email"
                :value="old('contact_email', $job->contact_email)"
                placeholder="Email where you want to receive applications" />

            <x-inputs.file id="company_logo" name="company_logo" label="Company Logo" />

            <button type="submit"
                class="w-full bg-green-500 hover:bg-green-600 text-white px-4 py-2 my-3 rounded focus:outline-none">
                Save
            </button>
        </form>
    </div>
</x-layout>