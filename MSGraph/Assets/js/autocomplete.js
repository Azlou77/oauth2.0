<script>
                            /* Event onclik for options in the form
                            Filled automatically the fields form*/
                            // None option
                            document.getElementById("none").addEventListener("click", fillFormN);

                            function fillFormN() {
                            document.getElementById("subject").value = "";
                            document.getElementById("body").value = "";
                            }

                            // Candidate option
                            document.getElementById("candidate").addEventListener("click", fillFormC);

                            function fillFormC() {
                            document.getElementById("subject").value = "Candidate";
                            document.getElementById("body").value = "Je m'appelle Louis et je suis actuellement à la recherche d'un stage de fin d'études dans le domaine de l'informatique. ";
                            }

                            // Recruiter option
                            document.getElementById("recruiters").addEventListener("click", fillFormR);
                            function fillFormR() {
                            document.getElementById("subject").value = "Recruiter";
                            document.getElementById("body").value = "Je m'appelle Louis et je recrute dans le domaine de l'informatique. ";
                            }
                        </script>
