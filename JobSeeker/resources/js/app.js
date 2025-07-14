import jQuery from "jquery"
import Swal from "sweetalert2"
import "./bootstrap"

// Make jQuery available globally
window.$ = window.jQuery = jQuery

// Make SweetAlert2 available globally
window.Swal = Swal

// CSRF Token setup for AJAX requests
jQuery.ajaxSetup({
  headers: {
    "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
  },
})

// Common utility functions
window.JobSeekerApp = {
  // Show loading state
  showLoading: (button) => {
    const originalText = button.innerHTML
    button.innerHTML = '<span class="spinner"></span> Loading...'
    button.disabled = true
    return originalText
  },

  // Hide loading state
  hideLoading: (button, originalText) => {
    button.innerHTML = originalText
    button.disabled = false
  },

  // Format date
  formatDate: (dateString) => {
    const options = { year: "numeric", month: "long", day: "numeric" }
    return new Date(dateString).toLocaleDateString("en-US", options)
  },

  // Show success message
  showSuccess: (message, callback = null) => {
    Swal.fire({
      title: "Success!",
      text: message,
      icon: "success",
      confirmButtonText: "OK",
      confirmButtonColor: "#10B981",
    }).then((result) => {
      if (result.isConfirmed && callback) {
        callback()
      }
    })
  },

  // Show error message
  showError: (message) => {
    Swal.fire({
      title: "Error!",
      text: message,
      icon: "error",
      confirmButtonText: "OK",
      confirmButtonColor: "#EF4444",
    })
  },

  // Show confirmation dialog
  showConfirmation: (title, text, callback) => {
    Swal.fire({
      title: title,
      text: text,
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#EF4444",
      cancelButtonColor: "#6B7280",
      confirmButtonText: "Yes, proceed!",
      cancelButtonText: "Cancel",
    }).then((result) => {
      if (result.isConfirmed) {
        callback()
      }
    })
  },

  // Validate form
  validateForm: (formElement) => {
    let isValid = true
    const requiredFields = formElement.querySelectorAll("[required]")

    requiredFields.forEach((field) => {
      if (!field.value.trim()) {
        isValid = false
        field.classList.add("border-red-500")
        field.classList.remove("border-gray-300")
      } else {
        field.classList.remove("border-red-500")
        field.classList.add("border-gray-300")
      }
    })

    return isValid
  },

  // Handle AJAX form submission
  submitForm: function (formElement, options = {}) {
    const defaultOptions = {
      method: "POST",
      showLoading: true,
      successMessage: "Operation completed successfully",
      errorMessage: "An error occurred. Please try again.",
      onSuccess: null,
      onError: null,
    }

    const config = { ...defaultOptions, ...options }

    if (!this.validateForm(formElement)) {
      this.showError("Please fill in all required fields")
      return
    }

    const submitButton = formElement.querySelector('button[type="submit"]')
    let originalText = ""

    if (config.showLoading && submitButton) {
      originalText = this.showLoading(submitButton)
    }

    jQuery.ajax({
      url: formElement.action || window.location.href,
      method: config.method,
      data: jQuery(formElement).serialize(),
      success: (response) => {
        if (config.showLoading && submitButton) {
          this.hideLoading(submitButton, originalText)
        }

        if (response.success !== false) {
          this.showSuccess(response.message || config.successMessage, config.onSuccess)
        } else {
          this.showError(response.message || config.errorMessage)
        }
      },
      error: (xhr) => {
        if (config.showLoading && submitButton) {
          this.hideLoading(submitButton, originalText)
        }

        const response = xhr.responseJSON
        const errorMessage = response?.message || config.errorMessage

        this.showError(errorMessage)

        if (config.onError) {
          config.onError(xhr)
        }
      },
    })
  },
}

// Initialize application when DOM is ready
document.addEventListener("DOMContentLoaded", () => {
  // Auto-hide alerts after 5 seconds
  const alerts = document.querySelectorAll(".alert")
  alerts.forEach((alert) => {
    setTimeout(() => {
      alert.style.opacity = "0"
      setTimeout(() => alert.remove(), 300)
    }, 5000)
  })

  // Add fade-in animation to cards
  const cards = document.querySelectorAll(".card")
  cards.forEach((card, index) => {
    setTimeout(() => {
      card.classList.add("fade-in")
    }, index * 100)
  })

  // Handle login form
  const loginForm = document.getElementById("loginForm")
  if (loginForm) {
    loginForm.addEventListener("submit", function (e) {
      e.preventDefault()

      JobSeekerApp.submitForm(this, {
        successMessage: "Login successful",
        onSuccess: () => {
          window.location.href = this.dataset.redirectUrl || "/dashboard"
        },
      })
    })
  }

  // Handle admin login form
  const adminLoginForm = document.getElementById("adminLoginForm")
  if (adminLoginForm) {
    adminLoginForm.addEventListener("submit", function (e) {
      e.preventDefault()

      JobSeekerApp.submitForm(this, {
        successMessage: "Login successful",
        onSuccess: () => {
          window.location.href = "/admin/dashboard"
        },
      })
    })
  }

  // Handle validation form
  const validationForm = document.getElementById("validationForm")
  if (validationForm) {
    validationForm.addEventListener("submit", function (e) {
      e.preventDefault()

      JobSeekerApp.submitForm(this, {
        successMessage: "Validation request submitted successfully",
        onSuccess: () => {
          window.location.reload()
        },
      })
    })
  }

  // Handle application form
  const applicationForm = document.getElementById("applicationForm")
  if (applicationForm) {
    applicationForm.addEventListener("submit", function (e) {
      e.preventDefault()

      // Check if at least one position is selected
      const selectedPositions = this.querySelectorAll('input[name="positions[]"]:checked')
      if (selectedPositions.length === 0) {
        JobSeekerApp.showError("Please select at least one position")
        return
      }

      JobSeekerApp.submitForm(this, {
        successMessage: "Application submitted successfully",
        onSuccess: () => {
          window.location.href = "/applications"
        },
      })
    })
  }

  // Handle admin validation update form
  const adminValidationForm = document.querySelector("#validationForm")
  if (adminValidationForm && window.location.pathname.includes("/admin/")) {
    adminValidationForm.addEventListener("submit", function (e) {
      e.preventDefault()

      JobSeekerApp.submitForm(this, {
        successMessage: "Validation status updated successfully",
        onSuccess: () => {
          window.location.reload()
        },
      })
    })
  }

  // Handle assign validator form
  const assignForm = document.getElementById("assignForm")
  if (assignForm) {
    assignForm.addEventListener("submit", function (e) {
      e.preventDefault()

      const validatorSelect = this.querySelector("#validator_id")
      if (!validatorSelect.value) {
        JobSeekerApp.showError("Please select a validator")
        return
      }

      JobSeekerApp.submitForm(this, {
        successMessage: "Validator assigned successfully",
        onSuccess: () => {
          window.location.reload()
        },
      })
    })
  }

  // Add smooth scrolling to anchor links
  document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
    anchor.addEventListener("click", function (e) {
      e.preventDefault()
      const target = document.querySelector(this.getAttribute("href"))
      if (target) {
        target.scrollIntoView({
          behavior: "smooth",
          block: "start",
        })
      }
    })
  })

  // Add hover effects to interactive elements
  const interactiveElements = document.querySelectorAll(".card, .btn-primary, .btn-secondary")
  interactiveElements.forEach((element) => {
    element.addEventListener("mouseenter", function () {
      this.style.transform = "translateY(-1px)"
      this.style.transition = "transform 0.2s ease-in-out"
    })

    element.addEventListener("mouseleave", function () {
      this.style.transform = "translateY(0)"
    })
  })
})

// Export for use in other modules
export default JobSeekerApp
