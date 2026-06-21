<?php

namespace Melios\Dev\Console\Command;

class Stubs
{
    public function parentElement(string $contentType, string $basePath)
    {
        $stubs = array_merge($this->getElementStubs(), $this->getParentElementSubs());

        return $this->process($stubs, $this->placeholders($contentType, $basePath));
    }

    public function element(string $contentType, string $basePath)
    {
        $stubs = $this->getElementStubs();

        return $this->process($stubs, $this->placeholders($contentType, $basePath));
    }

    private function getElementStubs(): array
    {
        return [
            '{{base_path}}/view/adminhtml/layout/pagebuilder_melios_{{content_type}}_form.xml' => [
                'content' => <<<TEXT
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
            <uiComponent name="pagebuilder_melios_{{content_type}}_form"/>
        </referenceContainer>
    </body>
</page>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/layout/pagebuilder_melios_{{content_type}}_mobile_form.xml' => [
                'content' => <<<TEXT
<?xml version="1.0"?>
<page xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:framework:View/Layout/etc/page_configuration.xsd">
    <body>
        <referenceContainer name="content">
            <uiComponent name="pagebuilder_melios_{{content_type}}_mobile_form"/>
        </referenceContainer>
    </body>
</page>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/pagebuilder/content_type/melios_{{content_type}}.xml' => [
                'content' => <<<TEXT
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_PageBuilder:etc/content_type.xsd">
    <type name="melios-{{content-type}}"
          label="{{Content Type}}"
          component="Magento_PageBuilder/js/content-type"
          preview_component="Melios_PageBuilderPro/js/content-type/{{content-type}}/preview"
          form="pagebuilder_melios_{{content_type}}_form"
          menu_section="layout"
          icon="icon-pagebuilder-melios icon-{{content-type}}"
          sortOrder="0"
          translate="label">
        <breakpoints>
            <breakpoint name="mobile">
                <form>pagebuilder_melios_{{content_type}}_mobile_form</form>
            </breakpoint>
        </breakpoints>
        <children default_policy="allow">
            <child name="melios-{{content-type}}" policy="deny"/>
        </children>
        <appearances>
            <appearance default="true"
                        name="default"
                        preview_template="Melios_PageBuilderPro/content-type/{{content-type}}/default/preview"
                        master_template="Melios_PageBuilderPro/content-type/{{content-type}}/default/master"
                        reader="Magento_PageBuilder/js/master-format/read/configurable">
                <elements>
                    <element name="main">
                        <style name="background_color" source="background_color"/>
                        <style name="background_image" source="background_image" converter="Magento_PageBuilder/js/converter/style/background-image" preview_converter="Magento_PageBuilder/js/converter/style/preview/background-image" persistence_mode="write"/>
                        <style name="background_position" source="background_position"/>
                        <style name="background_size" source="background_size"/>
                        <style name="background_repeat" source="background_repeat"/>
                        <style name="background_attachment" source="background_attachment"/>
                        <style name="border_width" source="border_width"/>
                        <style name="border_radius" source="border_radius"/>
                        <style name="border_color" source="border_color"/>
                        <style name="margins" storage_key="margins_and_padding" reader="Magento_PageBuilder/js/property/margins" converter="Magento_PageBuilder/js/converter/style/margins"/>
                        <style name="padding" storage_key="margins_and_padding" reader="Magento_PageBuilder/js/property/paddings" converter="Magento_PageBuilder/js/converter/style/paddings"/>
                        <style name="display" source="display" converter="Magento_PageBuilder/js/converter/style/display" preview_converter="Magento_PageBuilder/js/converter/style/preview/display"/>
                        <attribute name="name" source="data-content-type"/>
                        <attribute name="appearance" source="data-appearance"/>
                        <attribute name="background_images" source="data-background-images"/>
                        <css name="css_classes"/>
                    </element>
                </elements>
                <converters>
                    <converter name="background_images" component="Magento_PageBuilder/js/mass-converter/background-images">
                        <config>
                            <item name="attribute_name" value="background_images"/>
                            <item name="desktop_image_variable" value="background_image"/>
                            <item name="mobile_image_variable" value="mobile_image"/>
                        </config>
                    </converter>
                </converters>
            </appearance>
        </appearances>
    </type>
</config>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/ui_component/pagebuilder_melios_{{content_type}}_form.xml' => [
                'content' => <<<TEXT
<?xml version="1.0" encoding="UTF-8"?>
<form xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Ui:etc/ui_configuration.xsd"
      extends="pagebuilder_base_form_with_background_attributes">
    <argument name="data" xsi:type="array">
        <item name="template" xsi:type="string">templates/form/collapsible</item>
        <item name="js_config" xsi:type="array">
            <item name="provider" xsi:type="string">pagebuilder_melios_{{content_type}}_form.pagebuilder_melios_{{content_type}}_form_data_source</item>
        </item>
        <item name="label" xsi:type="string" translate="true">{{Content Type}}</item>
    </argument>
    <settings>
        <deps>
            <dep>pagebuilder_melios_{{content_type}}_form.pagebuilder_melios_{{content_type}}_form_data_source</dep>
        </deps>
        <namespace>pagebuilder_melios_{{content_type}}_form</namespace>
        <dataScope>data</dataScope>
        <buttons>
            <button name="save" class="Magento\PageBuilder\Block\Adminhtml\ContentType\Edit\SaveButton"/>
            <button name="close" class="Magento\PageBuilder\Block\Adminhtml\ContentType\Edit\ModalCloseButton"/>
        </buttons>
    </settings>
    <dataSource name="pagebuilder_melios_{{content_type}}_form_data_source">
        <argument name="data" xsi:type="array">
            <item name="js_config" xsi:type="array">
                <item name="component" xsi:type="string">Magento_PageBuilder/js/form/provider</item>
            </item>
        </argument>
        <dataProvider name="pagebuilder_melios_{{content_type}}_form_data_source" class="Magento\PageBuilder\Model\ContentType\DataProvider">
            <settings>
                <requestFieldName/>
                <primaryFieldName/>
            </settings>
        </dataProvider>
    </dataSource>
    <fieldset name="appearance_fieldset" sortOrder="10" component="Magento_PageBuilder/js/form/element/dependent-fieldset">
        <field name="appearance" formElement="select" sortOrder="10" component="Magento_PageBuilder/js/form/element/dependent-select">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="default" xsi:type="string">default</item>
                </item>
            </argument>
            <formElements>
                <select>
                    <settings>
                        <options>
                            <option name="0" xsi:type="array">
                                <item name="value" xsi:type="string">default</item>
                                <item name="label" xsi:type="string" translate="true">Default</item>
                            </option>
                        </options>
                    </settings>
                </select>
            </formElements>
        </field>
    </fieldset>
    <fieldset name="background" sortOrder="80"/>
    <fieldset name="advanced" sortOrder="90">
        <settings>
            <label translate="true">Advanced</label>
            <collapsible>true</collapsible>
            <opened>true</opened>
        </settings>
        <field name="text_align">
            <settings>
                <visible>false</visible>
            </settings>
        </field>
        <field name="border">
            <settings>
                <visible>false</visible>
            </settings>
        </field>
        <field name="css_classes" sortOrder="60" formElement="input">
            <settings>
                <dataType>text</dataType>
                <label translate="true">CSS Classes</label>
                <notice translate="true">Space separated list of classes.</notice>
                <validation>
                    <rule name="validate-css-class" xsi:type="boolean">true</rule>
                </validation>
            </settings>
        </field>
        <field name="border_width" sortOrder="70" formElement="input">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="default" xsi:type="string"></item>
                </item>
            </argument>
            <settings>
                <dataType>text</dataType>
                <label translate="true">Border Width</label>
                <placeholder>0px</placeholder>
                <addAfter translate="true">​</addAfter>
                <validation>
                    <rule name="validate-number" xsi:type="boolean">false</rule>
                    <rule name="greater-than-equals-to" xsi:type="boolean">false</rule>
                </validation>
                <additionalClasses>
                    <class name="admin__field-small">true</class>
                </additionalClasses>
                <imports>
                    <link name="setDisabled">false</link>
                </imports>
            </settings>
        </field>
        <field name="border_radius" sortOrder="80" formElement="input">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="default" xsi:type="string"></item>
                </item>
            </argument>
            <settings>
                <dataType>text</dataType>
                <label translate="true">Border Radius</label>
                <placeholder>0px</placeholder>
                <addAfter translate="true">​</addAfter>
                <validation>
                    <rule name="validate-number" xsi:type="boolean">false</rule>
                    <rule name="greater-than-equals-to" xsi:type="boolean">false</rule>
                </validation>
                <additionalClasses>
                    <class name="admin__field-small">true</class>
                </additionalClasses>
            </settings>
        </field>
        <field name="border_color" sortOrder="90" formElement="colorPicker">
            <settings>
                <label translate="true">Border Color</label>
                <componentType>colorPicker</componentType>
                <placeholder translate="true">No Color</placeholder>
                <validation>
                    <rule name="validate-color" xsi:type="boolean">true</rule>
                </validation>
                <additionalClasses>
                    <class name="admin__field-medium">true</class>
                </additionalClasses>
                <imports>
                    <link name="setDisabled">false</link>
                </imports>
            </settings>
            <formElements>
                <colorPicker>
                    <settings>
                        <colorPickerMode>full</colorPickerMode>
                        <colorFormat>hex</colorFormat>
                    </settings>
                </colorPicker>
            </formElements>
        </field>
        <field name="margins_and_padding" sortOrder="100" formElement="input" component="Magento_PageBuilder/js/form/element/margins-and-padding">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="default" xsi:type="null" />
                </item>
            </argument>
            <settings>
                <label translate="true">Margins and Padding</label>
                <placeholder translate="true">Default</placeholder>
                <validation>
                    <rule name="validate-number" xsi:type="boolean">true</rule>
                    <rule name="less-than-equals-to" xsi:type="number">999</rule>
                    <rule name="greater-than-equals-to" xsi:type="number">-999</rule>
                </validation>
            </settings>
        </field>
    </fieldset>
</form>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/ui_component/pagebuilder_melios_{{content_type}}_mobile_form.xml' => [
                'content' => <<<TEXT
<?xml version="1.0" encoding="UTF-8"?>
<form xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
      xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_Ui:etc/ui_configuration.xsd"
      extends="pagebuilder_melios_{{content_type}}_form">
    <argument name="data" xsi:type="array">
        <item name="js_config" xsi:type="array">
            <item name="provider" xsi:type="string">pagebuilder_melios_{{content_type}}_mobile_form.pagebuilder_melios_{{content_type}}_mobile_form_data_source</item>
        </item>
    </argument>
    <settings>
        <deps>
            <dep>pagebuilder_melios_{{content_type}}_mobile_form.pagebuilder_melios_{{content_type}}_mobile_form_data_source</dep>
        </deps>
        <namespace>pagebuilder_melios_{{content_type}}_mobile_form</namespace>
    </settings>
    <dataSource name="pagebuilder_melios_{{content_type}}_mobile_form_data_source">
        <argument name="data" xsi:type="array">
            <item name="js_config" xsi:type="array">
                <item name="component" xsi:type="string">Magento_PageBuilder/js/form/provider</item>
            </item>
        </argument>
        <dataProvider name="pagebuilder_melios_{{content_type}}_mobile_form_data_source" class="Magento\PageBuilder\Model\ContentType\DataProvider">
            <settings>
                <requestFieldName/>
                <primaryFieldName/>
            </settings>
        </dataProvider>
    </dataSource>
    <fieldset name="advanced">
        <field name="margins_and_padding">
            <argument name="data" xsi:type="array">
                <item name="config" xsi:type="array">
                    <item name="default" xsi:type="null" />
                    <item name="breakpoints" xsi:type="array">
                        <item name="mobile" xsi:type="boolean">true</item>
                    </item>
                </item>
            </argument>
            <settings>
                <additionalClasses>
                    <class name="admin__field-mobile-breakpoint-notice">true</class>
                </additionalClasses>
                <tooltip>
                    <description translate="true">
                        <![CDATA[
                        <p>Style changes will only affect this breakpoint</p>
                        ]]>
                    </description>
                </tooltip>
            </settings>
        </field>
    </fieldset>
</form>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/css/source/elements/_{{content-type}}.less' => [
                'content' => <<<TEXT
.icon-pagebuilder-melios.icon-{{content-type}}::before {
    .melios-icon('<svg xmlns="http://www.w3.org/2000/svg" width="18" height="14"><g fill="none" fill-rule="evenodd" transform="translate(-6 -1)"><rect width="16" height="3" x="7" y="11" fill="currentColor" rx="1"/><path fill="currentColor" d="M22 1a1 1 0 0 1 1 1v7a1 1 0 0 1-1 1H8a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1h14Zm0 3H8v5h14V4Z"/><path stroke="currentColor" stroke-linecap="square" d="M9.5 5.5h5M9.5 7.5h2"/></g></svg>');
}

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/js/content-type/{{content-type}}/preview.js' => [
                'content' => <<<TEXT
define([
    'Magento_PageBuilder/js/content-type/preview',
    'Magento_PageBuilder/js/content-type-menu/hide-show-option',
], function (
    Parent,
    HideShow
) {
    'use strict';

    return class {{ContentType}} extends Parent {
        retrieveOptions() {
            const options = super.retrieveOptions();

            options.hideShow = new HideShow({
                preview: this,
                icon: HideShow.showIcon,
                title: HideShow.showText,
                action: this.onOptionVisibilityToggle,
                classes: ['hide-show-content-type'],
                sort: 40
            });

            return options;
        }
    };
});

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/template/content-type/{{content-type}}/default/master.html' => [
                'content' => <<<TEXT
<melios-{{content-type}} ko-style="data.main.style" attr="data.main.attributes" css="data.main.css">
    Hello, world!
</melios-{{content-type}}>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/template/content-type/{{content-type}}/default/preview.html' => [
                'content' => <<<TEXT
<div class="pagebuilder-content-type pagebuilder-melios-{{content-type}}"
     event="{ mouseover: onMouseOver, mouseout: onMouseOut }, mouseoverBubble: false">
    <render args="getOptions().template"></render>
    <melios-{{content-type}} class="melios-{{content-type}}" css="data.main.css" attr="data.main.attributes" ko-style="data.main.style">
        Hello, world!
    </melios-{{content-type}}>
</div>

TEXT,
            ],
        ];
    }

    private function getParentElementStubs(): array
    {
        return [

            '{{base_path}}/view/adminhtml/pagebuilder/content_type/melios_{{content_type}}.xml' => [
                'content' => <<<TEXT
<?xml version="1.0"?>
<config xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"
        xsi:noNamespaceSchemaLocation="urn:magento:module:Magento_PageBuilder:etc/content_type.xsd">
    <type name="melios-{{content-type}}"
          label="{{Content Type}}"
          component="Magento_PageBuilder/js/content-type-collection"
          preview_component="Melios_PageBuilderPro/js/content-type/{{content-type}}/preview"
          master_component="Magento_PageBuilder/js/content-type/master-collection"
          form="pagebuilder_melios_{{content_type}}_form"
          menu_section="layout"
          icon="icon-pagebuilder-melios icon-{{content-type}}"
          sortOrder="0"
          translate="label">
        <breakpoints>
            <breakpoint name="mobile">
                <form>pagebuilder_melios_{{content_type}}_mobile_form</form>
            </breakpoint>
        </breakpoints>
        <parents default_policy="deny">
            <parent name="root-container" policy="allow"/>
            <parent name="row" policy="allow"/>
            <parent name="column" policy="allow"/>
            <parent name="tab-item" policy="allow"/>
            <parent name="melios-collapsible-item" policy="allow"/>
            <parent name="melios-container" policy="allow"/>
            <parent name="melios-showmore" policy="allow"/>
        </parents>
        <children default_policy="allow">
            <child name="melios-{{content-type}}" policy="deny"/>
        </children>
        <appearances>
            <appearance default="true"
                        name="default"
                        preview_template="Melios_PageBuilderPro/content-type/{{content-type}}/default/preview"
                        master_template="Melios_PageBuilderPro/content-type/{{content-type}}/default/master"
                        reader="Magento_PageBuilder/js/master-format/read/configurable">
                <elements>
                    <element name="main">
                        <style name="background_color" source="background_color"/>
                        <style name="background_image" source="background_image" converter="Magento_PageBuilder/js/converter/style/background-image" preview_converter="Magento_PageBuilder/js/converter/style/preview/background-image" persistence_mode="write"/>
                        <style name="background_position" source="background_position"/>
                        <style name="background_size" source="background_size"/>
                        <style name="background_repeat" source="background_repeat"/>
                        <style name="background_attachment" source="background_attachment"/>
                        <style name="border_width" source="border_width"/>
                        <style name="border_radius" source="border_radius"/>
                        <style name="border_color" source="border_color"/>
                        <style name="margins" storage_key="margins_and_padding" reader="Magento_PageBuilder/js/property/margins" converter="Magento_PageBuilder/js/converter/style/margins"/>
                        <style name="padding" storage_key="margins_and_padding" reader="Magento_PageBuilder/js/property/paddings" converter="Magento_PageBuilder/js/converter/style/paddings"/>
                        <style name="display" source="display" converter="Magento_PageBuilder/js/converter/style/display" preview_converter="Magento_PageBuilder/js/converter/style/preview/display"/>
                        <attribute name="name" source="data-content-type"/>
                        <attribute name="appearance" source="data-appearance"/>
                        <attribute name="background_images" source="data-background-images"/>
                        <css name="css_classes"/>
                    </element>
                </elements>
                <converters>
                    <converter name="background_images" component="Magento_PageBuilder/js/mass-converter/background-images">
                        <config>
                            <item name="attribute_name" value="background_images"/>
                            <item name="desktop_image_variable" value="background_image"/>
                            <item name="mobile_image_variable" value="mobile_image"/>
                        </config>
                    </converter>
                </converters>
            </appearance>
        </appearances>
    </type>
</config>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/js/content-type/{{content-type}}/preview.js' => [
                'content' => <<<TEXT
define([
    'Magento_PageBuilder/js/content-type/preview-collection',
    'Magento_PageBuilder/js/content-type-menu/hide-show-option',
], function (
    Parent,
    HideShow
) {
    'use strict';

    return class {{ContentType}} extends Parent {
        retrieveOptions() {
            const options = super.retrieveOptions();

            options.hideShow = new HideShow({
                preview: this,
                icon: HideShow.showIcon,
                title: HideShow.showText,
                action: this.onOptionVisibilityToggle,
                classes: ['hide-show-content-type'],
                sort: 40
            });

            return options;
        }

        getStyle(element, styleProperties) {
            const styles = element.style();
            const result = {};

            for (const key of styleProperties) {
                result[key] = styles[key];
            }

            return result;
        }

        getStyleWithout(element, styleProperties) {
            const styles = element.style();
            const result = {};

            for (const key in styles) {
                if (!styleProperties.includes(key)) {
                    result[key] = styles[key];
                }
            }

            return result;
        }
    };
});

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/template/content-type/{{content-type}}/default/master.html' => [
                'content' => <<<TEXT
<melios-{{content-type}} ko-style="data.main.style" attr="data.main.attributes" css="data.main.css">
    <render args="masterTemplate"></render>
</melios-{{content-type}}>

TEXT,
            ],

            '{{base_path}}/view/adminhtml/web/template/content-type/{{content-type}}/default/preview.html' => [
                'content' => <<<'TEXT'
<div class="pagebuilder-content-type pagebuilder-content-type-affordance pagebuilder-melios-{{content-type}}"
    attr="data.main.attributes"
    event="{ mouseover: onMouseOver, mouseout: onMouseOut }, mouseoverBubble: false"
    ko-style="getStyle(data.main, [
        'marginTop', 'marginBottom', 'marginLeft', 'marginRight'
    ])">
    <div class="pagebuilder-display-label" text="displayLabel().toUpperCase()"></div>
    <render args="getOptions().template"></render>
    <div class="pagebuilder-content-type" css="data.main.css"
        ko-style="getStyleWithout(data.main, [
            'marginTop', 'marginBottom', 'marginLeft', 'marginRight'
        ])">
        <div class="pagebuilder-content-type type-container pagebuilder-melios-{{content-type}}-content"
            css="Object.assign({'empty-container': contentType.children().length == 0}, {})">
            <div class="element-children content-type-container"
                each="contentType.getChildren()"
                css="getChildrenCss()"
                attr="{id: contentType.id + '-children'}"
                data-bind="sortable: getSortableOptions()"
                afterRender="function (element) { if (typeof afterChildrenRender === 'function') { afterChildrenRender(element); } }">
                <if args="$parent.isContainer()">
                    <div class="pagebuilder-drop-indicator"></div>
                </if>
                <div class="pagebuilder-content-type-wrapper"
                    template="{ name: preview.template, data: preview, afterRender: preview.dispatchAfterRenderEvent.bind(preview) }"
                    attr="{ id: id }" css="{'pagebuilder-content-type-hidden': !preview.display()}">
                </div>
                <if args="$parent.isContainer() && $index() === $parent.contentType.getChildren()().length - 1">
                    <div class="pagebuilder-drop-indicator"></div>
                </if>
            </div>
            <div class="pagebuilder-empty-container empty-placeholder"
                css="placeholderCss()"
                translate="'Drag images or icons here'"></div>
        </div>
    </div>
</div>

TEXT,
            ],
        ];
    }

    private function placeholders(string $contentType, string $basePath)
    {
        return [
            '{{base_path}}' => $basePath,
            '{{content_type}}' => $contentType,
            '{{content-type}}' => str_replace('_', '-', $contentType),
            '{{ContentType}}' => str_replace(' ', '', ucwords(str_replace('_', ' ', $contentType))),
            '{{Content Type}}' => ucwords(str_replace('_', ' ', $contentType)),
        ];
    }

    private function process(array $stubs, array $placeholders)
    {
        $result = [];

        foreach ($stubs as $path => $values) {
            $result[strtr($path, $placeholders)] = array_merge($values, [
                'content' => strtr($values['content'], $placeholders),
            ]);
        }

        return  $result;
    }
}
