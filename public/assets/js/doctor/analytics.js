        // Appointment Types Chart
        function createAppointmentTypesChart() {
          const canvas = document.getElementById('appointmentTypesChart');
          const ctx = canvas.getContext('2d');
          
          // Set canvas size
          canvas.width = canvas.offsetWidth;
          canvas.height = canvas.offsetHeight;

          // Chart data
          const data = {
              labels: ['Consultation', 'Follow-up', 'Emergency', 'Procedure'],
              values: [45, 30, 15, 10]
          };

          // Colors
          const colors = ['#0070f3', '#28a745', '#dc3545', '#ffc107'];

          // Total value
          const total = data.values.reduce((a, b) => a + b, 0);

          // Start angle and radius
          const centerX = canvas.width / 2;
          const centerY = canvas.height / 2;
          const radius = Math.min(centerX, centerY) * 0.8;

          let startAngle = 0;
          data.labels.forEach((label, index) => {
              const sliceAngle = (data.values[index] / total) * 2 * Math.PI;
              
              ctx.beginPath();
              ctx.moveTo(centerX, centerY);
              ctx.arc(centerX, centerY, radius, startAngle, startAngle + sliceAngle);
              ctx.closePath();
              
              ctx.fillStyle = colors[index];
              ctx.fill();

              // Label
              const midAngle = startAngle + sliceAngle / 2;
              const x = centerX + Math.cos(midAngle) * (radius * 1.3);
              const y = centerY + Math.sin(midAngle) * (radius * 1.3);
              
              ctx.fillStyle = '#333';
              ctx.textAlign = 'center';
              ctx.font = '12px Poppins';
              ctx.fillText(`${label} (${data.values[index]})`, x, y);

              startAngle += sliceAngle;
          });
      }

      // Appointment Status Chart
      function createAppointmentStatusChart() {
          const canvas = document.getElementById('appointmentStatusChart');
          const ctx = canvas.getContext('2d');
          
          // Set canvas size
          canvas.width = canvas.offsetWidth;
          canvas.height = canvas.offsetHeight;

          // Chart data
          const data = {
              labels: ['Completed', 'Pending', 'Cancelled'],
              values: [70, 20, 10]
          };

          // Colors
          const colors = ['#28a745', '#0070f3', '#dc3545'];

          // Total value
          const total = data.values.reduce((a, b) => a + b, 0);

          // Bar chart parameters
          const barWidth = canvas.width * 0.6;
          const barHeight = canvas.height * 0.7;
          const startX = (canvas.width - barWidth) / 2;
          const startY = canvas.height * 0.8;
          const spacing = barWidth / (data.labels.length + 1);

          // Draw bars
          data.labels.forEach((label, index) => {
              const barLength = (data.values[index] / total) * barHeight;
              
              // Bar
              ctx.fillStyle = colors[index];
              ctx.fillRect(
                  startX + (index + 1) * spacing, 
                  startY - barLength, 
                  spacing * 0.8, 
                  barLength
              );

              // Label
              ctx.fillStyle = '#333';
              ctx.textAlign = 'center';
              ctx.font = '12px Poppins';
              ctx.fillText(
                  `${label} (${data.values[index]})`, 
                  startX + (index + 1) * spacing + spacing * 0.4, 
                  startY + 20
              );
          });
      }

      // Create charts when page loads
      window.onload = function() {
          createAppointmentTypesChart();
          createAppointmentStatusChart();
      };