import React, { useState } from 'react';

const ContactForm = ({ className = '', showTitle = true }) => {
  const [formData, setFormData] = useState({
    name: '',
    email: '',
    phone: '',
    service: '',
    message: ''
  });

  const [status, setStatus] = useState({
    loading: false,
    success: false,
    error: null
  });

  const handleChange = (e) => {
    const { name, value } = e.target;
    setFormData(prev => ({
      ...prev,
      [name]: value
    }));
  };

  const handleSubmit = async (e) => {
    e.preventDefault();
    setStatus({ loading: true, success: false, error: null });

    try {
      console.log('Submitting form data:', formData); // Debug log

      const response = await fetch('https://infinoid.com/backend/process_form.php', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
          'Accept': 'application/json'
        },
        body: JSON.stringify(formData)
      });

      console.log('Response status:', response.status); // Debug log

      let data;
      try {
        const textResponse = await response.text();
        console.log('Raw response:', textResponse); // Debug log
        data = JSON.parse(textResponse);
      } catch (parseError) {
        console.error('Error parsing response:', parseError);
        throw new Error('Invalid response from server');
      }

      if (!response.ok) {
        throw new Error(data.message || `Server error: ${response.status}`);
      }

      if (data.success) {
        setStatus({ loading: false, success: true, error: null });
        setFormData({
          name: '',
          email: '',
          phone: '',
          service: '',
          message: ''
        });
      } else {
        throw new Error(data.message || 'Submission failed');
      }
    } catch (error) {
      console.error('Form submission error:', error);
      setStatus({
        loading: false,
        success: false,
        error: error.message || 'Failed to submit form. Please try again.'
      });
    }
  };

  return (
    <div className={`backdrop-blur-xl bg-gradient-to-br from-purple-900/30 to-blue-900/20 p-8 rounded-3xl border border-white/10 shadow-2xl ${className}`}>
      {showTitle && (
        <h2 className="text-3xl font-bold bg-gradient-to-r from-pink-400 via-blue-300 to-purple-400 bg-clip-text text-transparent mb-6">
          Contact Us
        </h2>
      )}
      
      <form onSubmit={handleSubmit} className="space-y-6">
        <div className="space-y-4">
          <input 
            type="text" 
            name="name" 
            value={formData.name} 
            onChange={handleChange} 
            placeholder="Full Name*" 
            required 
            className="w-full p-4 bg-white/5 rounded-xl border border-white/10 text-white placeholder-gray-400 focus:ring-2 focus:ring-purple-400" 
          />
          <input 
            type="email" 
            name="email" 
            value={formData.email} 
            onChange={handleChange} 
            placeholder="Email Address*" 
            required 
            className="w-full p-4 bg-white/5 rounded-xl border border-white/10 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-400" 
          />
          <input 
            type="tel" 
            name="phone" 
            value={formData.phone} 
            onChange={handleChange} 
            placeholder="Phone Number*" 
            required 
            className="w-full p-4 bg-white/5 rounded-xl border border-white/10 text-white placeholder-gray-400 focus:ring-2 focus:ring-blue-400" 
          />
          <select 
            name="service" 
            value={formData.service} 
            onChange={handleChange} 
            required 
            className="w-full p-4 bg-white/5 rounded-xl border border-white/10 text-white focus:ring-2 focus:ring-pink-400 appearance-none cursor-pointer"
          >
            <option value="" className="bg-gray-800 text-white">Select Service*</option>
            <option value="web-development" className="bg-gray-800 text-white">Web Development</option>
            <option value="mobile-app" className="bg-gray-800 text-white">Mobile App Development</option>
            <option value="ui-ux" className="bg-gray-800 text-white">UI/UX Design</option>
            <option value="digital-marketing" className="bg-gray-800 text-white">Digital Marketing</option>
            <option value="other" className="bg-gray-800 text-white">Other</option>
          </select>
          <textarea 
            name="message" 
            value={formData.message} 
            onChange={handleChange} 
            placeholder="Your message...*" 
            required 
            className="w-full p-4 bg-white/5 rounded-xl border border-white/10 text-white h-32 resize-none focus:ring-2 focus:ring-purple-400"
          ></textarea>
        </div>

        {status.error && <div className="text-red-400 text-sm">{status.error}</div>}
        {status.success && <div className="text-green-400 text-sm">Thank you! We'll be in touch soon.</div>}

        <button 
          type="submit" 
          disabled={status.loading} 
          className="w-full bg-gradient-to-r from-purple-500 to-pink-500 hover:from-purple-600 hover:to-pink-600 text-white font-semibold py-4 px-8 rounded-xl"
        >
          {status.loading ? 'Sending...' : 'Submit'}
        </button>
      </form>
    </div>
  );
};

export default ContactForm; 
