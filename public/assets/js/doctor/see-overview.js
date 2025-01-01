
  // Sample data for blood pressure: [{ date, systolic, diastolic }]
  const bloodPressureData = [
    { date: '2024-11-01', systolic: 120, diastolic: 80 },
    { date: '2024-11-05', systolic: 130, diastolic: 85 },
    { date: '2024-11-10', systolic: 125, diastolic: 82 },
    { date: '2024-11-15', systolic: 135, diastolic: 88 },
    { date: '2024-11-20', systolic: 140, diastolic: 90 }
  ];

  // Sample data for blood sugar: [{ date, fasting, postprandial }]
  const bloodSugarData = [
    { date: '2024-11-01', fasting: 90, postprandial: 110 },
    { date: '2024-11-05', fasting: 100, postprandial: 130 },
    { date: '2024-11-10', fasting: 95, postprandial: 120 },
    { date: '2024-11-15', fasting: 110, postprandial: 140 },
    { date: '2024-11-20', fasting: 105, postprandial: 135 }
  ];

  // Sample data for cholesterol: [{ date, ldl, hdl }]
  const cholesterolData = [
    { date: '2024-11-01', ldl: 110, hdl: 55 },
    { date: '2024-11-05', ldl: 130, hdl: 60 },
    { date: '2024-11-10', ldl: 120, hdl: 58 },
    { date: '2024-11-15', ldl: 140, hdl: 62 },
    { date: '2024-11-20', ldl: 135, hdl: 59 }
  ];

  // Function to draw a line chart
  function drawLineChart(canvasId, data, labels, colors) {
    const canvas = document.getElementById(canvasId);
    const ctx = canvas.getContext('2d');
    canvas.width = canvas.clientWidth;
    canvas.height = canvas.clientHeight;

    const padding = 40;
    const chartWidth = canvas.width - 2 * padding;
    const chartHeight = canvas.height - 2 * padding;

    // Find the max value for scaling
    const maxValue = Math.max(...data.flatMap(d => labels.map(label => d[label])));

    // Clear the canvas
    ctx.clearRect(0, 0, canvas.width, canvas.height);

    // Draw the axes
    ctx.beginPath();
    ctx.moveTo(padding, padding);
    ctx.lineTo(padding, canvas.height - padding);
    ctx.lineTo(canvas.width - padding, canvas.height - padding);
    ctx.stroke();

    // Draw labels
    ctx.font = '18px Arial';
    ctx.fillText('Date', canvas.width / 2, canvas.height - 10);
    ctx.save();
    ctx.rotate(-Math.PI / 2);
    ctx.fillText(labels.join(' / '), -canvas.height / 2, 20);
    ctx.restore();

    const xGap = chartWidth / (data.length - 1);

    // Plot each line
    labels.forEach((label, index) => {
      ctx.strokeStyle = colors[index];
      ctx.lineWidth = 2;
      ctx.beginPath();

      data.forEach((item, i) => {
        const x = padding + i * xGap;
        const y = canvas.height - padding - (item[label] / maxValue) * chartHeight;
        i === 0 ? ctx.moveTo(x, y) : ctx.lineTo(x, y);

        // Mark the points
        ctx.arc(x, y, 3, 0, 2 * Math.PI);
      });

      ctx.stroke();
    });

    // Legend
    labels.forEach((label, index) => {
      ctx.fillStyle = colors[index];
      ctx.fillText(label, canvas.width - 100, padding + 20 * (index + 1));
    });
  }

  // Draw blood pressure chart
  drawLineChart('bpChart', bloodPressureData, ['systolic', 'diastolic'], ['red', 'blue']);

  // Draw blood sugar chart
  drawLineChart('bsChart', bloodSugarData, ['fasting', 'postprandial'], ['green', 'purple']);

  // Draw cholesterol chart
  drawLineChart('cholesterolChart', cholesterolData, ['ldl', 'hdl'], ['orange', 'cyan']);