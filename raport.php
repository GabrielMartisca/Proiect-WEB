<?php
if(!isset($_COOKIE["loggedin"])&&!isset($_COOKIE["loggedindont"])){
	header("Location:login.php");
}
?>
<!DOCTYPE html>
<html>
    <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
    <title>Raport</title>
    </head>
    <body>
        <article>
            <header>
                <h1>CuPO Report</h1>
                <div role="contentinfo">
                    <dl>
                      <dt>Authors</dt>
                      <dd>
                        Mărtișcă Gabriel
                        &amp;
                        <a>Soci Lucian</a>,
                      </dd>
                    </dl>
                  </div>
            </header>
              <section typeof="sa:Abstract" id="abstract" role="doc-abstract">
                <h2>Abstract</h2>
                <p>
                  This project develops a web application utilizing Open Food Facts data and a REST/GraphQL API to manage culinary preferences. It offers features for metadata management, dietary restrictions, shopping list creation, and user administration. The application provides insightful analytics, enabling informed food choices and enhancing culinary experiences.
                </p>
              </section>
              <section id="introduction" role="doc-introduction">
                <!-- review? -->
                <h2>Introduction</h2>
                <p>
                  In the ever-evolving world of culinary preferences and dietary requirements, managing food choices effectively demands intuitive tools that harness rich data sources. This project introduces a comprehensive web application that addresses this demand by seamlessly integrating Open Food Facts data with a versatile REST/GraphQL API. Beyond mere functionality, the application prioritizes user empowerment, offering intuitive interfaces for navigating dietary preferences, creating personalized shopping lists, and administering user accounts. Additionally, its robust analytics capabilities provide users with valuable insights into consumption patterns and emerging food trends, fostering informed decision-making and enriching culinary experiences. By bridging the gap between data-driven functionalities and user-centric design principles, this project aims to revolutionize how individuals and groups interact with food, ultimately promoting healthier and more fulfilling lifestyles.
                </p>   
              </section>
              <section id="pruduct-scope">
                <h2>Product Scope</h2>
                <p>
                    Our software is a revolutionary web application designed to transform the way individuals and groups manage their culinary preferences. By harnessing the vast repository of data available from Open Food Facts and exposing a REST/GraphQL API, our application provides users with an intuitive platform to navigate dietary choices, create personalized shopping lists, and gain valuable insights into their consumption patterns.

                    The primary purpose of our software is to empower users to make informed decisions about their food selection, leading to healthier and more fulfilling culinary experiences. By streamlining the management of culinary preferences and providing robust support for activities such as user administration and analytics generation, our software aligns with corporate goals of promoting health and wellness, driving user engagement, and enhancing customer satisfaction.
                </p>
              </section>
              <section id="product-functions">
                <h2>Product Functions</h2>
                <ul>
                    <li>Manage culinary preferences for individuals or groups</li>
                    <li>Support creation and management of shopping lists</li>
                    <li>Provide user administration functionalities</li>
                    <li>Generate statistics on consumption patterns and dietary preferences</li>
                    <li>Export statistics in open formats such as CSV and PDF</li>
                </ul>
              </section> 
              <section id="user-classes-and-characteristics">
                <h2>User Classes And Characteristics</h2>
                <ul>
                    <li>Casual users: Individuals who use the application occasionally for managing their culinary preferences and creating shopping lists.</li>
                    <li>Enthusiasts: Users who are passionate about cooking and frequently explore new recipes and ingredients using the application.</li>
                    <li>Administrators: Users responsible for managing user accounts and access permissions within the application.</li>
                </ul>
              </section>
              <section id="operating-environment">
                <h2>Operating Environment</h2>
                <ul>
                    <li>Hardware Platform: Compatible with desktop and mobile devices</li>
                    <li>Operating System: Compatible with major operating systems including Windows, macOS, iOS, and Android</li>
                    <li>Software Components: Requires access to Open Food Facts database and integration with REST/GraphQL API</li>
                </ul>
              </section>
              <section id="assumptions-and-dependencies">
                <h2>Assumptions and Dependencies</h2>
                <ul>
                    <li>Assumed access to Open Food Facts data and API for retrieving food-related information</li>
                    <li>Dependencies on external factors such as network connectivity for accessing data from Open Food Facts</li>
                </ul>
              </section>
              <section id="user-interfaces">
                <h2>User Interfaces</h2>
                <ul>
                    <li>Intuitive interfaces for managing culinary preferences, creating shopping lists, and accessing analytics</li>
                    <li>Sample screen images and GUI standards provided to ensure consistent user experience</li>
                    <li>Error message display standards and keyboard shortcuts incorporated for user convenience</li>
                </ul> 
              </section>
              <section id="system-features">
                <h2>System Features</h2>
                <h3>1.User Authentication and Authorization</h3>
                <ul>
                    <li>Description: Enable users to securely log in and manage access permissions.</li>
                    <li>Priority: High</li>
                    <li>Stimulus/Response Sequences:</li>
                    <ul>
                        <li>User enters login credentials.</li>
                        <li>System verifies credentials and grants access to authorized functionalities</li>
                    </ul>
                    <li>Functional Requirements</li>
                    <ul>
                        <li>Authenticate user credentials against stored information.</li>
                        <li>Authorize access based on user role and permissions.</li>
                    </ul>
                </ul>
                <h3>2.Culinary Preferences Management</h3>
                <ul>
                    <li>Description: Allow users to specify dietary preferences, restrictions, and favorite ingredients.</li>
                    <li>Priority: High</li>
                    <li>Stimulus/Response Sequences:</li>
                    <ul>
                        <li>User navigates to preferences section.</li>
                        <li>User selects preferred dietary options and ingredients.</li>
                    </ul>
                    <li>Functional Requirements</li>
                    <ul>
                        <li>Provide options for selecting dietary preferences such as vegetarian, vegan, gluten-free, etc.</li>
                        <li>Allow users to specify allergens and food restrictions.</li>
                    </ul>
                </ul>
                <h3>3.Shopping List Creation</h3>
                <ul>
                    <li>Description: Enable users to create and manage personalized shopping lists based on their culinary preferences.</li>
                    <li>Priority: High</li>
                    <li>Stimulus/Response Sequences:</li>
                    <ul>
                        <li>User adds items to the shopping list.</li>
                        <li>System updates the list in real-time.</li>
                    </ul>
                    <li>Functional Requirements:</li>
                    <ul>
                        <li>Allow users to add items from the database of available food products.</li>
                        <li>Provide options for categorizing items and setting quantities.</li>
                    </ul>
                </ul>
                <h3>4.Analytics Generation</h3>
                <ul>
                    <li>Description: Generate statistics and insights based on user's consumption patterns and dietary preferences.</li>
                    <li>Priority: Medium</li>
                    <li>Stimulus/Response Sequences:</li>
                    <ul>
                        <li>User requests analytics report.</li>
                        <li>System processes data and generates report.</li>
                    </ul>
                    <li>Functional Requirements:</li>
                    <ul>
                        <li>Analyze user's shopping history to identify consumption patterns.</li>
                        <li>Provide visualizations and summaries of dietary preferences and trends.</li>
                    </ul>
                </ul>
                <h3>5.Exportable Statistics</h3>
                <ul>
                    <li>Description: Allow users to export generated statistics in open formats such as CSV and PDF.</li>
                    <li>Priority: Medium</li>
                    <li>Stimulus/Response Sequences:</li>
                    <ul>
                        <li>User selects export option.</li>
                        <li>System generates and downloads file.</li>
                    </ul>
                    <li>Functional Requirements:</li>
                    <ul>
                        <li>Provide options for selecting desired format (CSV or PDF).</li>
                        <li>Include relevant data fields and formatting in the exported file.</li>
                    </ul>
                </ul>
              </section>
              <section id="references">
                <h2>References:</h2>
                <ul>
                    <li>Open Food Facts: <a href="https://world.openfoodfacts.org/">https://world.openfoodfacts.org/</a></li>
                    <li>REST API Documentation:<a href="https://docs.github.com/en/rest/guides">https://docs.github.com/en/rest/guides</a></li>
                    <li>GraphQL API Documentation: <a href="https://docs.github.com/en/graphql">https://docs.github.com/en/graphql</a></li>
                </ul>
              </section>
        </article>
    </body>
</html>