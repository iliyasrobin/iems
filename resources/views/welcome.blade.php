<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8"/>
  <meta name="viewport" content="width=device-width,initial-scale=1"/>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>IEMS - ICT Equipment Management System</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=Poppins:wght@400;500;600;700&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
  <style>
    :root {
      --primary: #4361ee;
      --primary-dark: #3a56d4;
      --success: #06d6a0;
      --success-dark: #05c091;
      --danger: #ef476f;
      --danger-dark: #e12952;
      --card-bg: rgba(255, 255, 255, 0.9);
      --text-primary: #2b2d42;
      --text-secondary: #5a6285;
    }

    body {
      background-color: #f8f9fa;
      min-height: 100vh;
      font-family: 'Inter', sans-serif;
      color: var(--text-primary);
      overflow-x: hidden;
      position: relative;
    }
    
    body::before {
      content: '';
      position: fixed;
      top: 0;
      right: 0;
      bottom: 0;
      left: 0;
      background: linear-gradient(120deg, #e0f7fa 0%, #f5f7fa 100%);
      z-index: -1;
    }
    
    .shape {
      position: absolute;
      border-radius: 50%;
      filter: blur(80px);
    }
    
    .shape-1 {
      width: 300px;
      height: 300px;
      background: rgba(67, 97, 238, 0.2);
      top: -100px;
      right: -100px;
      z-index: -1;
    }
    
    .shape-2 {
      width: 400px;
      height: 400px;
      background: rgba(6, 214, 160, 0.15);
      bottom: -150px;
      left: -150px;
      z-index: -1;
    }
    
    .shape-3 {
      width: 200px;
      height: 200px;
      background: rgba(239, 71, 111, 0.1);
      top: 40%;
      right: 20%;
      z-index: -1;
    }
    
    .card-custom {
      border: none;
      border-radius: 20px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.05), 0 5px 15px rgba(0, 0, 0, 0.05);
      background-color: var(--card-bg);
      transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
      backdrop-filter: blur(15px);
      overflow: hidden;
      transform: translateZ(0);
    }
    
    .card-custom:hover {
      transform: translate3d(0, -10px, 0);
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1), 0 10px 20px rgba(0, 0, 0, 0.05);
    }
    
    .btn-custom {
      border-radius: 12px;
      padding: 0.75rem 1.25rem;
      font-weight: 600;
      letter-spacing: 0.3px;
      transition: all 0.35s cubic-bezier(0.165, 0.84, 0.44, 1);
      position: relative;
      overflow: hidden;
    }
    
    .btn-custom::after {
      content: '';
      position: absolute;
      width: 0;
      height: 100%;
      top: 0;
      left: 0;
      background-color: rgba(255, 255, 255, 0.2);
      transition: width 0.3s ease;
      z-index: -1;
      border-radius: inherit;
    }
    
    .btn-custom:hover::after {
      width: 100%;
    }
    
    .btn-primary-custom {
      background: linear-gradient(145deg, var(--primary), var(--primary-dark));
      border: none;
      box-shadow: 0 6px 15px -3px rgba(67, 97, 238, 0.4);
      color: white !important;
    }
    
    .btn-primary-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px -5px rgba(67, 97, 238, 0.5);
    }
    
    .btn-success-custom {
      background: linear-gradient(145deg, var(--success), var(--success-dark));
      border: none;
      box-shadow: 0 6px 15px -3px rgba(6, 214, 160, 0.4);
      color: white !important;
    }
    
    .btn-success-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px -5px rgba(6, 214, 160, 0.5);
    }
    
    .btn-danger-custom {
      background: linear-gradient(145deg, var(--danger), var(--danger-dark));
      border: none;
      box-shadow: 0 6px 15px -3px rgba(239, 71, 111, 0.4);
      color: white !important;
    }
    
    .btn-danger-custom:hover {
      transform: translateY(-3px);
      box-shadow: 0 10px 25px -5px rgba(239, 71, 111, 0.5);
    }
    
    .logo-container {
      width: 110px;
      height: 110px;
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      background: linear-gradient(-45deg, var(--primary), var(--primary-dark));
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0 auto 1.5rem;
      box-shadow: 0 10px 30px -5px rgba(67, 97, 238, 0.5);
      position: relative;
      transition: all 0.6s ease;
      animation: morphing 10s infinite;
    }
    
    .logo-container:hover {
      transform: rotate(5deg) scale(1.05);
    }
    
    .logo-container::after {
      content: '';
      position: absolute;
      width: 120%;
      height: 120%;
      border-radius: inherit;
      background: transparent;
      border: 2px solid rgba(67, 97, 238, 0.3);
      top: -10%;
      left: -10%;
      animation: pulse 3s infinite;
    }
    
    .logo-container i {
      filter: drop-shadow(0 2px 4px rgba(0, 0, 0, 0.2));
    }
    
    @keyframes pulse {
      0% {
        transform: scale(0.95);
        opacity: 1;
      }
      70% {
        transform: scale(1.1);
        opacity: 0;
      }
      100% {
        transform: scale(0.95);
        opacity: 0;
      }
    }
    
    @keyframes morphing {
      0% {
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      }
      25% {
        border-radius: 58% 42% 75% 25% / 76% 46% 54% 24%;
      }
      50% {
        border-radius: 50% 50% 33% 67% / 55% 27% 73% 45%;
      }
      75% {
        border-radius: 33% 67% 58% 42% / 63% 68% 32% 37%;
      }
      100% {
        border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      }
    }
    
    .wave-bg {
      position: fixed;
      bottom: 0;
      left: 0;
      width: 100%;
      height: 100px;
      background: url('data:image/svg+xml;utf8,<svg viewBox="0 0 1200 120" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none"><path d="M0,0V46.29c47.79,22.2,103.59,32.17,158,28,70.36-5.37,136.33-33.31,206.8-37.5C438.64,32.43,512.34,53.67,583,72.05c69.27,18,138.3,24.88,209.4,13.08,36.15-6,69.85-17.84,104.45-29.34C989.49,25,1113-14.29,1200,52.47V0Z" opacity="0.15" fill="%234361ee"></path><path d="M0,0V15.81C13,36.92,27.64,56.86,47.69,72.05,99.41,111.27,165,111,224.58,91.58c31.15-10.15,60.09-26.07,89.67-39.8,40.92-19,84.73-46,130.83-49.67,36.26-2.85,70.9,9.42,98.6,31.56,31.77,25.39,62.32,62,103.63,73,40.44,10.79,81.35-6.69,119.13-24.28s75.16-39,116.92-43.05c59.73-5.85,113.28,22.88,168.9,38.84,30.2,8.66,59,6.17,87.09-7.5,22.43-10.89,48-26.93,60.65-49.24V0Z" opacity="0.1" fill="%234361ee"></path></svg>');
      background-size: cover;
      background-repeat: no-repeat;
      z-index: -1;
    }
    
    h1 {
      font-family: 'Poppins', sans-serif;
      font-weight: 700;
      margin-bottom: 0.5rem;
      position: relative;
      display: inline-block;
      background: linear-gradient(135deg, var(--primary) 0%, #6b8cff 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .text-gradient {
      background: linear-gradient(90deg, var(--primary) 0%, var(--success) 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    
    .btn-icon {
      margin-right: 8px;
      transition: transform 0.3s ease;
    }
    
    .btn:hover .btn-icon {
      transform: translateX(3px);
    }
    
    .subtitle {
      color: var(--text-secondary);
      font-size: 1.1rem;
      margin-bottom: 2rem;
      font-weight: 500;
    }
    
    .shine-effect {
      position: relative;
      overflow: hidden;
    }
    
    .shine-effect::after {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 50%;
      height: 100%;
      background: linear-gradient(
        90deg, 
        transparent, 
        rgba(255, 255, 255, 0.3), 
        transparent
      );
      transition: 0.5s;
    }
    
    .shine-effect:hover::after {
      left: 100%;
    }
    
    .feature-icon {
      width: 48px;
      height: 48px;
      border-radius: 12px;
      display: flex;
      align-items: center;
      justify-content: center;
      margin-bottom: 1rem;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.1);
      background: linear-gradient(135deg, #f5f7fa 0%, #e0f7fa 100%);
    }
    
    footer {
      margin-top: 2rem;
      padding: 1rem 0;
    }
    
    @media (max-width: 576px) {
      .logo-container {
        width: 90px;
        height: 90px;
      }
      
      h1 {
        font-size: 1.75rem;
      }
      
      .subtitle {
        font-size: 1rem;
      }
      
      .btn-lg {
        font-size: 1rem;
        padding: 0.6rem 1rem;
      }
    }
  </style>
</head>
<body>
  <!-- Background elements -->
  <div class="shape shape-1"></div>
  <div class="shape shape-2"></div>
  <div class="shape shape-3"></div>
  <div class="wave-bg"></div>

  <div class="container d-flex flex-column justify-content-center align-items-center min-vh-100 py-5">
    <div class="card-custom p-4 p-md-5 animate__animated animate__fadeIn" style="width: 100%; max-width: 600px;">
      <div class="text-center">
        <div class="logo-container mb-4">
          <i class="bi bi-bar-chart-fill text-white" style="font-size: 2.5rem;"></i>
        </div>
        
        <h1 class="display-5 fw-bold mb-2">Welcome to IEMS</h1>
        <p class="subtitle">ICT Equipment Management System</p>

    <!-- Features section -->
        <div class="row g-4 mt-3 mb-4 text-center">
          <div class="col-md-4">
            <div class="feature-icon mx-auto">
              <i class="bi bi-box-seam text-primary"></i>
            </div>
            <h5 class="fw-bold">ICT Equipment Management</h5>
            <p class="text-muted small">Track all equipment easily</p>
          </div>
          
          <div class="col-md-4">
            <div class="feature-icon mx-auto">
              <i class="bi bi-graph-up text-success"></i>
            </div>
            <h5 class="fw-bold">Performance Analysis</h5>
            <p class="text-muted small">Data-driven insights</p>
          </div>
          
          <div class="col-md-4">
            <div class="feature-icon mx-auto">
              <i class="bi bi-shield-check text-danger"></i>
            </div>
            <h5 class="fw-bold">Secure System</h5>
            <p class="text-muted small">Protected data access</p>
          </div>
        </div>
      
        @guest
          <div class="d-flex flex-column flex-md-row gap-3 w-100 mt-3">
            <a href="{{ route('login') }}" class="btn btn-primary-custom btn-lg flex-fill shine-effect">
              <i class="bi bi-box-arrow-in-right btn-icon"></i> Login to Dashboard
            </a>
            
            <a href="{{ route('register') }}" class="btn btn-success-custom btn-lg flex-fill shine-effect">
              <i class="bi bi-person-plus btn-icon"></i> Create Account
            </a>
          </div>
        @else
          <div class="d-flex flex-column flex-md-row gap-3 w-100 mt-3">
            <a href="{{ route('dashboard') }}" class="btn btn-primary-custom btn-lg flex-fill shine-effect">
              <i class="bi bi-speedometer2 btn-icon"></i> Go to Dashboard
            </a>

            <form action="{{ route('logout') }}" method="POST" class="m-0 flex-fill">
              @csrf
              <button type="submit" class="btn btn-danger-custom btn-lg w-100 shine-effect">
                <i class="bi bi-box-arrow-right btn-icon"></i> Logout
              </button>
            </form>
          </div>
        @endguest
      </div>
    </div>
    
    <footer class="text-center animate__animated animate__fadeInUp animate__delay-1s">
      <p class="small text-muted mb-1">&copy; {{ date('Y') }} IEMS. All rights reserved.</p>
      <p class="small text-muted">Version 1.0</p>
    </footer>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Add scroll reveal animation
      const elements = document.querySelectorAll('.feature-icon, h5, .subtitle');
      
      elements.forEach((el, index) => {
        setTimeout(() => {
          el.classList.add('animate__animated', 'animate__fadeIn');
        }, 300 + (index * 100));
      });
    });
  </script>
</body>
</html>
