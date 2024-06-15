<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmailTemplateSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('email_templates')->insert([
            [
                'name' => 'Contact Us Reply Template',
                'subject' => '',
                'body' => '',
            ],
            [
                'name' => 'Contact Us Reply Template',
                'subject' => 'Thank you for contacting {company_name}',
                'body' => '<p>Dear {customer_name},</p><p>Thank you for reaching out to {company_name}. We appreciate you taking the time to contact us about your travel plans and inquiries.<br><br>[ADD REPLY HERE]</p><p>If you have any further questions or need additional information, please do not hesitate to reply to this email, and we will promptly respond to ensure your travel plans are seamless and enjoyable.</p><p>Thank you again for your message, and we look forward to helping you plan your next adventure.</p><p>Best regards,</p><p>{admin_name},<br>{company_name}.</p>',
            ],
            [
                'name' => 'Testimonial Reply Template',
                'subject' => 'We Loved Your Feedback on {company_name}',
                'body' => '<p>Dear {customer_name},</p><p>We hope you had an incredible time during your recent adventure with {company_name}. Your satisfaction is our top priority, and we greatly appreciate that you took few moments to share your experience with us.<br><br>[ADD REPLY HERE]</p><p>If you have any further questions or need additional information, please do not hesitate to reply to this email, and we will promptly respond to ensure your travel plans are seamless and enjoyable.</p><p>Thank you again for your message, and we look forward to helping you plan your next adventure.</p><p>Best regards,</p><p>{admin_name},<br>{company_name}.</p>',
            ],
            [
                'name' => 'Package Inquiry Reply Template',
                'subject' => 'Re: Inquiry About Your Package - {package_name}',
                'body' => "<p>Dear {customer_name},<br><br>Thank you for your inquiry about our {package_name} package. We're delighted to provide you with more information about this exciting travel opportunity.</p><p>[ADD REPLY HERE]<br><br>Our team will be happy to answer any additional questions you may have and assist you with customizing your travel plans.Please note that availability is limited, and packages are subject to sell out, so we recommend booking early to secure your preferred travel dates.</p><p>We look forward to helping you plan an unforgettable {package_name} experience with {company_name}.Best regards,</p><p>{admin_name},<br>{company_name}.</p>"
            ],
            [
                'name' => 'Rating Reply Template',
                'subject' => 'Thank you for your feedback on {package_name}',
                'body' => "<p>Dear {customer_name},</p><p>We truly appreciate you taking the time to provide a rating and feedback on our {package_name} package. Your input is invaluable to us, and it helps us continuously improve our offerings and deliver exceptional travel experiences.<br><br>[ADD REPLY HERE]</p><p>We're delighted to hear that you enjoyed your {package_name} experience with {company_name}. Your positive rating and kind words about [highlight specific aspects mentioned in the feedback] mean a great deal to our team.</p><p>At {company_name}, we strive to create unforgettable memories for our customers, and your feedback reassures us that we're on the right track. Your satisfaction is our top priority, and we'll continue to work hard to exceed your expectations.</p><p>Thank you again for choosing {company_name} and for sharing your valuable feedback. We hope you'll consider us for your future travel plans and continue to be a part of our journey.</p><p>Best regards,</p><p>{admin_name},<br>{company_name}.</p>"
            ],
            [
                'name' => 'Booking Confirmation Template',
                'subject' => 'Confirmation of Your Booking with {company_name}',
                'body' => "<p>Dear {customer_name},</p><p>Thank you for booking with {company_name}. We are delighted to have you as our valued customer and look forward to providing you with an unforgettable experience.<br>&nbsp;</p><p>[ADD MORE INFO HERE]<br><br>Please review the enclosed documents for detailed information about your itinerary, accommodation, and other important details related to your trip.</p><p><br>A few important reminders:</p><ol><li>Travel Documentation: Please ensure that you and all members of your party have valid passports and any required visas or entry permits for your destination.</li><li>Travel Insurance: We strongly recommend that you purchase comprehensive travel insurance to protect against unforeseen circumstances such as trip cancellations, medical emergencies, or loss of baggage.</li></ol><p>Thank you again for choosing {company_name}. We look forward to welcoming you on this exciting adventure.</p><p>Best regards,&nbsp;<br>{admin_name},<br>{company_name}</p>"
            ],
        ]);
    }
}
