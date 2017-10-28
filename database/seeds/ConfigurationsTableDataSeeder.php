<?php

use Illuminate\Database\Seeder;

class ConfigurationsTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('configurations')->insert([
            'id'            => 1,
            'user_id'       => 1,
            'software_id'   => 1,
            'content'       => base64_decode('PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iV2luZG93cy0xMjUyIiA/Pgo8Tm90ZXBhZFBsdXM+CiAgICA8RmluZEhpc3RvcnkgbmJNYXhGaW5kSGlzdG9yeVBhdGg9IjEwIiBuYk1heEZpbmRIaXN0b3J5RmlsdGVyPSIxMCIgbmJNYXhGaW5kSGlzdG9yeUZpbmQ9IjEwIiBuYk1heEZpbmRIaXN0b3J5UmVwbGFjZT0iMTAiIG1hdGNoV29yZD0ibm8iIG1hdGNoQ2FzZT0ibm8iIHdyYXA9InllcyIgZGlyZWN0aW9uRG93bj0ieWVzIiBmaWZSZWN1aXNpdmU9InllcyIgZmlmSW5IaWRkZW5Gb2xkZXI9Im5vIiBkbGdBbHdheXNWaXNpYmxlPSJubyIgZmlmRmlsdGVyRm9sbG93c0RvYz0ibm8iIGZpZkZvbGRlckZvbGxvd3NEb2M9Im5vIiBzZWFyY2hNb2RlPSIwIiB0cmFuc3BhcmVuY3lNb2RlPSIxIiB0cmFuc3BhcmVuY3k9IjE1MCIgZG90TWF0Y2hlc05ld2xpbmU9Im5vIj4KICAgICAgICA8UGF0aCBuYW1lPSJDOlxVc2Vyc1xhZG1pblxEb2N1bWVudHNcZ2l0XGxlZ2lvbiIgLz4KICAgICAgICA8UGF0aCBuYW1lPSIuIiAvPgogICAgICAgIDxGaWx0ZXIgbmFtZT0iKi4qIiAvPgogICAgICAgIDxGaW5kIG5hbWU9ImxvY2FsaG9zdCIgLz4KICAgICAgICA8UmVwbGFjZSBuYW1lPSJyb290IiAvPgogICAgPC9GaW5kSGlzdG9yeT4KICAgIDxGaWxlQnJvd3NlciAvPgogICAgPEhpc3RvcnkgbmJNYXhGaWxlPSIxMCIgaW5TdWJNZW51PSJubyIgY3VzdG9tTGVuZ3RoPSItMSI+CiAgICAgICAgPEZpbGUgZmlsZW5hbWU9IkM6XFVzZXJzXGFkbWluXEFwcERhdGFcUm9hbWluZ1xOb3RlcGFkKytcY29uZmlnLnhtbCIgLz4KICAgIDwvSGlzdG9yeT4KICAgIDxHVUlDb25maWdzPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iVG9vbEJhciIgdmlzaWJsZT0ieWVzIj5zdGFuZGFyZDwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iU3RhdHVzQmFyIj5zaG93PC9HVUlDb25maWc+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJUYWJCYXIiIGRyYWdBbmREcm9wPSJ5ZXMiIGRyYXdUb3BCYXI9InllcyIgZHJhd0luYWN0aXZlVGFiPSJ5ZXMiIHJlZHVjZT0ieWVzIiBjbG9zZUJ1dHRvbj0ieWVzIiBkb3VibGVDbGljazJDbG9zZT0ibm8iIHZlcnRpY2FsPSJubyIgbXVsdGlMaW5lPSJubyIgaGlkZT0ibm8iIHF1aXRPbkVtcHR5PSJubyIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IlNjaW50aWxsYVZpZXdzU3BsaXR0ZXIiPnZlcnRpY2FsPC9HVUlDb25maWc+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJVc2VyRGVmaW5lRGxnIiBwb3NpdGlvbj0idW5kb2NrZWQiPmhpZGU8L0dVSUNvbmZpZz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IlRhYlNldHRpbmciIHJlcGxhY2VCeVNwYWNlPSJubyIgc2l6ZT0iNCIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IkFwcFBvc2l0aW9uIiB4PSI3MiIgeT0iOTEiIHdpZHRoPSI4MzIiIGhlaWdodD0iNzAwIiBpc01heGltaXplZD0ibm8iIC8+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJub1VwZGF0ZSIgaW50ZXJ2YWxEYXlzPSIxNSIgbmV4dFVwZGF0ZURhdGU9IjIwMTcxMDEwIj5ubzwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iQXV0by1kZXRlY3Rpb24iPnllczwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iQ2hlY2tIaXN0b3J5RmlsZXMiPm5vPC9HVUlDb25maWc+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJUcmF5SWNvbiI+bm88L0dVSUNvbmZpZz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9Ik1haXRhaW5JbmRlbnQiPnllczwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iVGFnc01hdGNoSGlnaExpZ2h0IiBUYWdBdHRySGlnaExpZ2h0PSJ5ZXMiIEhpZ2hMaWdodE5vbkh0bWxab25lPSJubyI+eWVzPC9HVUlDb25maWc+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJSZW1lbWJlckxhc3RTZXNzaW9uIj55ZXM8L0dVSUNvbmZpZz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IkRldGVjdEVuY29kaW5nIj55ZXM8L0dVSUNvbmZpZz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9Ik5ld0RvY0RlZmF1bHRTZXR0aW5ncyIgZm9ybWF0PSIwIiBlbmNvZGluZz0iNCIgbGFuZz0iMCIgY29kZXBhZ2U9Ii0xIiBvcGVuQW5zaUFzVVRGOD0ieWVzIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0ibGFuZ3NFeGNsdWRlZCIgZ3IwPSIwIiBncjE9IjAiIGdyMj0iMCIgZ3IzPSIwIiBncjQ9IjAiIGdyNT0iMCIgZ3I2PSIwIiBncjc9IjAiIGdyOD0iMCIgZ3I5PSIwIiBncjEwPSIwIiBncjExPSIwIiBncjEyPSIwIiBsYW5nTWVudUNvbXBhY3Q9InllcyIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IlByaW50IiBsaW5lTnVtYmVyPSJ5ZXMiIHByaW50T3B0aW9uPSIzIiBoZWFkZXJMZWZ0PSIiIGhlYWRlck1pZGRsZT0iIiBoZWFkZXJSaWdodD0iIiBmb290ZXJMZWZ0PSIiIGZvb3Rlck1pZGRsZT0iIiBmb290ZXJSaWdodD0iIiBoZWFkZXJGb250TmFtZT0iIiBoZWFkZXJGb250U3R5bGU9IjAiIGhlYWRlckZvbnRTaXplPSIwIiBmb290ZXJGb250TmFtZT0iIiBmb290ZXJGb250U3R5bGU9IjAiIGZvb3RlckZvbnRTaXplPSIwIiBtYXJnZUxlZnQ9IjAiIG1hcmdlUmlnaHQ9IjAiIG1hcmdlVG9wPSIwIiBtYXJnZUJvdHRvbT0iMCIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IkJhY2t1cCIgYWN0aW9uPSIwIiB1c2VDdXN0dW1EaXI9Im5vIiBkaXI9IiIgaXNTbmFwc2hvdE1vZGU9InllcyIgc25hcHNob3RCYWNrdXBUaW1pbmc9IjcwMDAiIC8+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJUYXNrTGlzdCI+eWVzPC9HVUlDb25maWc+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJNUlUiPnllczwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iVVJMIj4yPC9HVUlDb25maWc+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJnbG9iYWxPdmVycmlkZSIgZmc9Im5vIiBiZz0ibm8iIGZvbnQ9Im5vIiBmb250U2l6ZT0ibm8iIGJvbGQ9Im5vIiBpdGFsaWM9Im5vIiB1bmRlcmxpbmU9Im5vIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iYXV0by1jb21wbGV0aW9uIiBhdXRvQ0FjdGlvbj0iMyIgdHJpZ2dlckZyb21OYkNoYXI9IjEiIGF1dG9DSWdub3JlTnVtYmVycz0ieWVzIiBmdW5jUGFyYW1zPSJ5ZXMiIC8+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJhdXRvLWluc2VydCIgcGFyZW50aGVzZXM9Im5vIiBicmFja2V0cz0ibm8iIGN1cmx5QnJhY2tldHM9Im5vIiBxdW90ZXM9Im5vIiBkb3VibGVRdW90ZXM9Im5vIiBodG1sWG1sVGFnPSJubyIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9InNlc3Npb25FeHQiPjwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0id29ya3NwYWNlRXh0Ij48L0dVSUNvbmZpZz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9Ik1lbnVCYXIiPnNob3c8L0dVSUNvbmZpZz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IkNhcmV0IiB3aWR0aD0iMSIgYmxpbmtSYXRlPSI2MDAiIC8+CiAgICAgICAgPEdVSUNvbmZpZyBuYW1lPSJTY2ludGlsbGFHbG9iYWxTZXR0aW5ncyIgZW5hYmxlTXVsdGlTZWxlY3Rpb249Im5vIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0ib3BlblNhdmVEaXIiIHZhbHVlPSIwIiBkZWZhdWx0RGlyUGF0aD0iIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0idGl0bGVCYXIiIHNob3J0PSJubyIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9InN0eWxlclRoZW1lIiBwYXRoPSJDOlxVc2Vyc1xhZG1pblxBcHBEYXRhXFJvYW1pbmdcTm90ZXBhZCsrXHN0eWxlcnMueG1sIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0id29yZENoYXJMaXN0IiB1c2VEZWZhdWx0PSJ5ZXMiIGNoYXJzQWRkZWQ9IiIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9ImRlbGltaXRlclNlbGVjdGlvbiIgbGVmdG1vc3REZWxpbWl0ZXI9IjQwIiByaWdodG1vc3REZWxpbWl0ZXI9IjQxIiBkZWxpbWl0ZXJTZWxlY3Rpb25PbkVudGlyZURvY3VtZW50PSJubyIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9Im11bHRpSW5zdCIgc2V0dGluZz0iMCIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9Ik1JU0MiIGZpbGVTd2l0Y2hlcldpdGhvdXRFeHRDb2x1bW49Im5vIiBiYWNrU2xhc2hJc0VzY2FwZUNoYXJhY3RlckZvclNxbD0ieWVzIiBuZXdTdHlsZVNhdmVEbGc9Im5vIiBpc0ZvbGRlckRyb3BwZWRPcGVuRmlsZXM9Im5vIiBkb2NQZWVrT25UYWI9Im5vIiBkb2NQZWVrT25NYXA9Im5vIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0ic2VhcmNoRW5naW5lIiBzZWFyY2hFbmdpbmVDaG9pY2U9IjIiIHNlYXJjaEVuZ2luZUN1c3RvbT0iIiAvPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iU21hcnRIaWdoTGlnaHQiIG1hdGNoQ2FzZT0ibm8iIHdob2xlV29yZE9ubHk9InllcyIgdXNlRmluZFNldHRpbmdzPSJubyIgb25Bbm90aGVyVmlldz0ibm8iPnllczwvR1VJQ29uZmlnPgogICAgICAgIDxHVUlDb25maWcgbmFtZT0iU2NpbnRpbGxhUHJpbWFyeVZpZXciIGxpbmVOdW1iZXJNYXJnaW49InNob3ciIGJvb2tNYXJrTWFyZ2luPSJzaG93IiBpbmRlbnRHdWlkZUxpbmU9InNob3ciIGZvbGRlck1hcmtTdHlsZT0iYm94IiBsaW5lV3JhcE1ldGhvZD0iYWxpZ25lZCIgY3VycmVudExpbmVIaWxpdGluZ1Nob3c9InNob3ciIHNjcm9sbEJleW9uZExhc3RMaW5lPSJubyIgZGlzYWJsZUFkdmFuY2VkU2Nyb2xsaW5nPSJubyIgd3JhcFN5bWJvbFNob3c9ImhpZGUiIFdyYXA9Im5vIiBib3JkZXJFZGdlPSJ5ZXMiIGVkZ2U9Im5vIiBlZGdlTmJDb2x1bW49IjgwIiB6b29tPSIwIiB6b29tMj0iMCIgd2hpdGVTcGFjZVNob3c9ImhpZGUiIGVvbFNob3c9ImhpZGUiIGJvcmRlcldpZHRoPSIyIiBzbW9vdGhGb250PSJubyIgLz4KICAgICAgICA8R1VJQ29uZmlnIG5hbWU9IkRvY2tpbmdNYW5hZ2VyIiBsZWZ0V2lkdGg9IjIxMyIgcmlnaHRXaWR0aD0iMjAwIiB0b3BIZWlnaHQ9IjIwMCIgYm90dG9tSGVpZ2h0PSIyMDAiPgogICAgICAgICAgICA8UGx1Z2luRGxnIHBsdWdpbk5hbWU9Ik5vdGVwYWQrKzo6SW50ZXJuYWxGdW5jdGlvbiIgaWQ9IjQ0MDg1IiBjdXJyPSIwIiBwcmV2PSItMSIgaXNWaXNpYmxlPSJubyIgLz4KICAgICAgICAgICAgPFBsdWdpbkRsZyBwbHVnaW5OYW1lPSJkdW1teSIgaWQ9IjAiIGN1cnI9IjMiIHByZXY9Ii0xIiBpc1Zpc2libGU9InllcyIgLz4KICAgICAgICAgICAgPEFjdGl2ZVRhYnMgY29udD0iMCIgYWN0aXZlVGFiPSItMSIgLz4KICAgICAgICAgICAgPEFjdGl2ZVRhYnMgY29udD0iMSIgYWN0aXZlVGFiPSItMSIgLz4KICAgICAgICAgICAgPEFjdGl2ZVRhYnMgY29udD0iMiIgYWN0aXZlVGFiPSItMSIgLz4KICAgICAgICAgICAgPEFjdGl2ZVRhYnMgY29udD0iMyIgYWN0aXZlVGFiPSItMSIgLz4KICAgICAgICA8L0dVSUNvbmZpZz4KICAgIDwvR1VJQ29uZmlncz4KICAgIDxQcm9qZWN0UGFuZWxzPgogICAgICAgIDxQcm9qZWN0UGFuZWwgaWQ9IjAiIHdvcmtTcGFjZUZpbGU9IiIgLz4KICAgICAgICA8UHJvamVjdFBhbmVsIGlkPSIxIiB3b3JrU3BhY2VGaWxlPSIiIC8+CiAgICAgICAgPFByb2plY3RQYW5lbCBpZD0iMiIgd29ya1NwYWNlRmlsZT0iIiAvPgogICAgPC9Qcm9qZWN0UGFuZWxzPgo8L05vdGVwYWRQbHVzPgo=')
        ]);
    }
}
